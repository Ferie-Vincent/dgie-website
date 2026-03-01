<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory, SoftDeletes;
    use \App\Traits\Auditable;

    // Slug generation handled by ArticleController (with uniqueness check)

    protected $fillable = ['title', 'slug', 'excerpt', 'content', 'image', 'category_id', 'dossier_id', 'author_id', 'status', 'section', 'published_at', 'read_time', 'is_featured', 'featured_position'];

    protected function casts(): array
    {
        return ['published_at' => 'datetime', 'is_featured' => 'boolean'];
    }

    public function category() { return $this->belongsTo(Category::class); }
    public function dossier() { return $this->belongsTo(Dossier::class); }
    public function author() { return $this->belongsTo(User::class, 'author_id'); }
    public function comments() { return $this->hasMany(Comment::class); }
    public function faqs() { return $this->morphMany(FaqItem::class, 'faqable'); }
    public function images() { return $this->hasMany(ArticleImage::class)->orderBy('order'); }

    public function scopePublished($query) { return $query->where('status', 'publie'); }
    public function scopeFeatured($query) { return $query->where('is_featured', true); }
    public function scopeSection($query, $section) { return $query->where('section', $section); }
}
