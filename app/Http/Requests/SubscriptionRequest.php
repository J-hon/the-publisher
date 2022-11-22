<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'url' => ['required', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'url' => 'Enter a valid URL'
        ];
    }

}
