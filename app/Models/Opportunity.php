<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Opportunity extends Model
{
    use \App\Traits\Auditable;

    protected static function booted(): void
    {
        static::creating(fn ($model) => $model->slug = $model->slug ?: Str::slug($model->title));
        static::updating(fn ($model) => $model->slug = Str::slug($model->title));
    }

    protected $fillable = [
        'title', 'slug', 'description', 'content', 'image', 'type',
        'organisme', 'location', 'url', 'date_limite',
        'is_featured', 'is_active', 'order',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'date_limite' => 'date',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->date_limite && $this->date_limite->isPast();
    }

    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'emploi' => 'Emploi',
            'investissement' => 'Investissement',
            'formation' => 'Formation',
            'bourse' => 'Bourse',
            'appel_a_projets' => 'Appel à projets',
            default => ucfirst($this->type),
        };
    }
}
