<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::creating(fn ($model) => $model->slug = $model->slug ?: Str::slug($model->name));
        static::updating(fn ($model) => $model->slug = Str::slug($model->name));
    }

    protected $fillable = ['name', 'slug', 'color'];

    public function articles() { return $this->hasMany(Article::class); }
}
