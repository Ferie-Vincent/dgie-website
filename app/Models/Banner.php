<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title', 'image', 'url', 'alt_text', 'position', 'is_active', 'order'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function scopeActive($query) { return $query->where('is_active', true)->orderBy('order'); }
    public function scopePosition($query, $position) { return $query->where('position', $position); }
}
