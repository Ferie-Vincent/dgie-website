<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolkitItem extends Model
{
    protected $fillable = ['title', 'description', 'icon_color', 'url', 'order', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function scopeActive($query) { return $query->where('is_active', true)->orderBy('order'); }
}
