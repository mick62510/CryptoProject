<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CryptoEntriesFormFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'required|mimes:jpeg,jpg,png|max:10000'
        ];
    }

    public function messages(): array
    {
        return [
            'file.mimes' => 'Le fichier doit être au format (jpeg,jpg,png) et 10mo .max',
        ];
    }
}
