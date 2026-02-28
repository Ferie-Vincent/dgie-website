<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|max:150|unique:newsletter_subscribers,email',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Veuillez indiquer votre adresse e-mail.',
            'email.email'    => 'Veuillez saisir une adresse e-mail valide.',
            'email.unique'   => 'Cette adresse e-mail est déjà inscrite à notre newsletter.',
        ];
    }
}
