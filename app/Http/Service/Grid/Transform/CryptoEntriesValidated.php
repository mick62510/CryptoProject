<?php

namespace App\Http\Service\Grid\Transform;

use App\Http\Service\Grid\Config\Interface\toArrayInterface;
use App\Models\Enums\CryptoEntriesTrendEnum;
use App\Models\Enums\CryptoEntriesTrendTypeEnum;

class CryptoEntriesValidated extends CryptoEntriesNotValidated implements toArrayInterface
{
    public function toArray(): array
    {
        $data = $this->data;
        $data = array_merge($data, parent::toArray());
        $data['image_after_result'] = asset('storage/' . $data['image_after_result']);

        if ($data['result'] === 'win') {
            $data['result'] = '<i class="bg-success text-white text-margin">' . $data['result'] . '</i>';
        } elseif ($data['result'] === 'loose') {
            $data['result'] = '<i class="bg-danger text-white text-margin">' . $data['result'] . '</i>';
        } else {
            $data['result'] = '<i class="bg-warning text-white text-margin">' . $data['result'] . '</i>';
        }

        return $data;
    }

}
