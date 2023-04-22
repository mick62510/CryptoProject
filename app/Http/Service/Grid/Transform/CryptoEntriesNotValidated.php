<?php

namespace App\Http\Service\Grid\Transform;

use App\Http\Service\Grid\Config\Interface\toArrayInterface;
use App\Models\Enums\CryptoEntriesTrendEnum;
use App\Models\Enums\CryptoEntriesTrendTypeEnum;

class CryptoEntriesNotValidated implements toArrayInterface
{
    public function __construct(public array $data)
    {
    }

    public function toArray(): array
    {
        $data = $this->data;

        $data['trend'] = CryptoEntriesTrendEnum::fromName($data['trend'])->value;
        $data['image_before_result'] = asset('storage/' . $data['image_before_result']);
        $data['area_d'] = (bool)$data['area_d'] ? 'Oui' : 'Non';
        $data['area_h4'] = (bool)$data['area_h4'] ? 'Oui' : 'Non';
        $data['area_h1'] = (bool)$data['area_h1'] ? 'Oui' : 'Non';
        $data['area_m30'] = (bool)$data['area_m30'] ? 'Oui' : 'Non';

        if ($data['trend_type'] === 'bullish') {
            $data['trend_type'] = '<i class="material-icons text-success">trending_up</i>';
        } elseif ($data['trend_type'] === 'bearish') {
            $data['trend_type'] = '<i class="material-icons text-danger">trending_down</i>';
        }

        return $data;
    }

}
