<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'parent_id', 'name', 'email', 'content', 'is_admin', 'is_approved'];

    protected function casts(): array
    {
        return ['is_admin' => 'boolean', 'is_approved' => 'boolean'];
    }

    public function article() { return $this->belongsTo(Article::class); }
    public function parent() { return $this->belongsTo(Comment::class, 'parent_id'); }
    public function replies() { return $this->hasMany(Comment::class, 'parent_id'); }

    public function scopeApproved($query) { return $query->where('is_approved', true); }
    public function scopePending($query) { return $query->where('is_approved', false); }
}
