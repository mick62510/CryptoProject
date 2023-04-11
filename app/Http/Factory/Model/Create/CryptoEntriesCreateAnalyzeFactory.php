<?php

namespace App\Http\Factory\Model\Create;

use App\Http\Interface\ModelCreateFactoryInterface;
use App\Models\CryptoEntriesAnalyze;

class CryptoEntriesCreateAnalyzeFactory implements ModelCreateFactoryInterface
{

    public function create(mixed $data): CryptoEntriesAnalyze
    {
        $model = new CryptoEntriesAnalyze;
        $this->fill($model, $data);

        return $model;
    }

    public function fill(CryptoEntriesAnalyze $model, array $data): void
    {
        $model->double_bot = array_key_exists('double_bot', $data) ? $data['double_bot'] : null;
        $model->double_top = array_key_exists('double_top', $data) ? $data['double_top'] : null;
        $model->divergence = array_key_exists('divergence', $data) ? $data['divergence'] : null;
        $model->bulle = array_key_exists('bulle', $data) ? $data['bulle'] : null;
    }
}
