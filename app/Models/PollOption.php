<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
    protected $fillable = ['poll_question_id', 'label', 'votes_count', 'percentage', 'order'];

    public function question() { return $this->belongsTo(PollQuestion::class, 'poll_question_id'); }
}
