<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqItem extends Model
{
    use HasFactory;

    protected $fillable = ['faqable_id', 'faqable_type', 'question', 'answer', 'order'];

    public function faqable() { return $this->morphTo(); }
}
