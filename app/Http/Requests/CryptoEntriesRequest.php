<?php

namespace App\Http\Requests;

use App\Models\Enums\CryptoEntriesTrendEnum;
use App\Models\Enums\CryptoEntriesTrendTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class CryptoEntriesRequest extends FormRequest
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
            'date' => 'required',
            'actif_code' => 'required',
            'trend' => ['required', 'in:' . CryptoEntriesTrendEnum::toNamesString()],
            'trend_type' => ['required', 'in:' . CryptoEntriesTrendTypeEnum::toNamesString()],
            'risk_reward' => 'required',
            'bullish_breakout' => 'nullable',
            'bearish_breakout' => 'nullable',
            'integration' => 'nullable',
            'zone_d' => 'nullable',
            'zone_h4' => 'nullable',
            'zone_h1' => 'nullable',
            'zone_m30' => 'nullable',
            'double_bot' => 'nullable',
            'double_top' => 'nullable',
            'divergence' => 'nullable',
            'bulle' => 'nullable',
            'text_before_result' => 'nullable',
            'image_before_result' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'created_at.required' => 'Le champ Date et Heure est obligatoire',
            'actif_code.required' => 'Le champ Actif est obligatoire',
            'trend.required' => 'Le champ Type est obligatoire',
            'trend_type.required' => 'Le champ Tendance est obligatoire',
            'risk_reward.required' => 'Le champ RR est obligatoire',
        ];
    }
}
