<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollVoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'poll_option_id'   => 'required|exists:poll_options,id',
            'poll_question_id' => 'required|exists:poll_questions,id',
        ];
    }
}
