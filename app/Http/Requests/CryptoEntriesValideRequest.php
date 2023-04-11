<?php

namespace App\Http\Requests;

use App\Models\Enums\CryptoEntriesTrendEnum;
use App\Models\Enums\CryptoEntriesTrendTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class CryptoEntriesValideRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'text_after_result' => 'nullable',
            'image_after_result' => 'nullable',
            'result' => 'required',
        ];
    }
}
