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

        return $data;
    }

}
