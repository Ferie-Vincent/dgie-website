<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'article_id' => 'required|exists:articles,id',
            'parent_id'  => 'nullable|exists:comments,id',
            'name'       => 'required|string|max:100',
            'email'      => 'required|email|max:150',
            'content'    => 'required|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Veuillez indiquer votre nom.',
            'email.required'   => 'Veuillez indiquer votre adresse e-mail.',
            'email.email'      => 'Veuillez saisir une adresse e-mail valide.',
            'content.required' => 'Veuillez saisir votre commentaire.',
            'content.max'      => 'Votre commentaire ne doit pas dépasser 1000 caractères.',
        ];
    }
}
