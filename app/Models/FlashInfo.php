<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashInfo extends Model
{
    use HasFactory;

    protected $table = 'flash_infos';
    protected $fillable = ['content', 'is_active', 'order'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function scopeActive($query) { return $query->where('is_active', true)->orderBy('order'); }
}
