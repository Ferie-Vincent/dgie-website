<?php

namespace App\Traits;

use App\Models\AuditLog;

trait Auditable
{
    public static function bootAuditable(): void
    {
        static::created(function ($model) {
            self::logAudit($model, 'created', 'Création de ' . class_basename($model) . ' #' . $model->id);
        });

        static::updated(function ($model) {
            if ($dirty = $model->getDirty()) {
                $changes = [];
                foreach ($dirty as $key => $newValue) {
                    if (in_array($key, ['password', 'remember_token'])) continue;
                    $changes[$key] = ['old' => $model->getOriginal($key), 'new' => $newValue];
                }
                if (!empty($changes)) {
                    self::logAudit($model, 'updated', 'Modification de ' . class_basename($model) . ' #' . $model->id, $changes);
                }
            }
        });

        static::deleted(function ($model) {
            self::logAudit($model, 'deleted', 'Suppression de ' . class_basename($model) . ' #' . $model->id);
        });
    }

    private static function logAudit($model, string $action, string $description, ?array $changes = null): void
    {
        if (!auth()->check()) return;

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'description' => $description,
            'changes' => $changes,
            'ip_address' => request()->ip(),
        ]);
    }
}
