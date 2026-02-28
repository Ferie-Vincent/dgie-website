<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:2000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Veuillez indiquer votre nom.',
            'email.required'   => 'Veuillez indiquer votre adresse e-mail.',
            'email.email'      => 'Veuillez saisir une adresse e-mail valide.',
            'subject.required' => 'Veuillez choisir un sujet.',
            'message.required' => 'Veuillez saisir votre message.',
            'message.max'      => 'Votre message ne doit pas dépasser 2000 caractères.',
        ];
    }
}
