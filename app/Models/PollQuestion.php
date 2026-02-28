<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollQuestion extends Model
{
    protected $fillable = ['question', 'is_active', 'total_votes'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function options() { return $this->hasMany(PollOption::class); }

    public function scopeActive($query) { return $query->where('is_active', true); }
}
