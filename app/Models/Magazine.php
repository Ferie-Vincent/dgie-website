<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Magazine extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'cover_image', 'pdf_file', 'published_at', 'description', 'is_active', 'order'];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query) { return $query->where('is_active', true)->orderBy('order'); }
}
