<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalerieItem extends Model
{
    use HasFactory;

    protected $fillable = ['album_id', 'title', 'file_path', 'type', 'order'];

    public function album() { return $this->belongsTo(GalerieAlbum::class, 'album_id'); }
}
