<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class GalerieAlbum extends Model
{
    use HasFactory, SoftDeletes;
    use \App\Traits\Auditable;

    protected static function booted(): void
    {
        static::creating(fn ($model) => $model->slug = $model->slug ?: Str::slug($model->title));
        static::updating(fn ($model) => $model->slug = Str::slug($model->title));
    }

    protected $fillable = ['title', 'slug', 'type', 'cover_image', 'description', 'event_date', 'location', 'items_count', 'status'];

    protected $casts = [
        'event_date' => 'date',
    ];

    public function items() { return $this->hasMany(GalerieItem::class, 'album_id'); }
    public function scopePublished($query) { return $query->where('status', 'publie'); }
}
