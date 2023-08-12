<?php

namespace App\Http\Factory\Model\Create;

use App\Http\Interface\ModelCreateFactoryInterface;
use App\Models\CryptoEntriesZone;

class CryptoEntriesCreateZoneFactory implements ModelCreateFactoryInterface
{
    public function create(mixed $data): CryptoEntriesZone
    {
        $model = new CryptoEntriesZone;
        $this->fill($model, $data);

        return $model;
    }

    public function fill(CryptoEntriesZone $model, array $data): void
    {
        $model->area_d = array_key_exists('area_d', $data) ? $data['area_d'] ? 1 : null : null;
        $model->area_h4 = array_key_exists('area_h4', $data) ? $data['area_h4'] ? 1 : null : null;
        $model->area_h1 = array_key_exists('area_h1', $data) ? $data['area_h1'] ? 1 : null : null;
        $model->area_m30 = array_key_exists('area_m30', $data) ? $data['area_m30'] ? 1 : null : null;
    }
}
