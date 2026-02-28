<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = ['page_slug', 'dossier_id', 'name', 'context', 'route', 'return_year', 'quote', 'avatar', 'tags', 'type', 'order', 'is_active'];

    protected function casts(): array
    {
        return ['tags' => 'array', 'is_active' => 'boolean'];
    }

    public function dossier() { return $this->belongsTo(Dossier::class); }

    public function scopeActive($query) { return $query->where('is_active', true)->orderBy('order'); }
    public function scopeByPage($query, $slug) { return $query->where('page_slug', $slug); }
}
