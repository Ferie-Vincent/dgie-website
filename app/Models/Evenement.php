<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Evenement extends Model
{
    use HasFactory, SoftDeletes;
    use \App\Traits\Auditable;

    protected static function booted(): void
    {
        static::creating(fn ($model) => $model->slug = $model->slug ?: Str::slug($model->title));
        static::updating(fn ($model) => $model->slug = Str::slug($model->title));
    }

    protected $fillable = ['title', 'slug', 'description', 'location', 'event_date', 'end_date', 'image', 'is_featured', 'status', 'section'];

    protected function casts(): array
    {
        return ['event_date' => 'datetime', 'end_date' => 'datetime', 'is_featured' => 'boolean'];
    }

    public function scopePublished($query) { return $query->where('status', 'publie'); }
    public function scopeFeatured($query) { return $query->where('is_featured', true); }
    public function scopeSection($query, $section) { return $query->where('section', $section); }
}
