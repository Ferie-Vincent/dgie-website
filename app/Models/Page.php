<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'meta_description',
        'meta_title', 'og_image', 'hero_title', 'hero_subtitle',
    ];
}
