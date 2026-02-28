<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Dossier extends Model
{
    use HasFactory, SoftDeletes;
    use \App\Traits\Auditable;

    protected static function booted(): void
    {
        static::creating(fn ($model) => $model->slug = $model->slug ?: Str::slug($model->title));
        static::updating(fn ($model) => $model->slug = Str::slug($model->title));
    }

    protected $fillable = ['title', 'slug', 'description', 'content', 'image', 'department', 'order', 'status'];

    public function articles() { return $this->hasMany(Article::class); }
    public function testimonials() { return $this->hasMany(Testimonial::class); }
    public function faqs() { return $this->morphMany(FaqItem::class, 'faqable'); }

    public function scopePublished($query) { return $query->where('status', 'publie'); }
}
