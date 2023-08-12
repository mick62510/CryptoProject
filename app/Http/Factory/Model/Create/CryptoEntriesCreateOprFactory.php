<?php

namespace App\Http\Factory\Model\Create;

use App\Http\Interface\ModelCreateFactoryInterface;
use App\Models\CryptoEntriesOpr;

class CryptoEntriesCreateOprFactory implements ModelCreateFactoryInterface
{

    public function create(mixed $data): CryptoEntriesOpr
    {
        $model = new CryptoEntriesOpr;
        $this->fill($model, $data);

        return $model;
    }

    public function fill(CryptoEntriesOpr $model, array $data): void
    {
        $model->bullish_breakout = array_key_exists('bullish_breakout', $data) ? $data['bullish_breakout'] : null;
        $model->bearish_breakout = array_key_exists('bearish_breakout', $data) ? $data['bearish_breakout'] : null;
        $model->integration = array_key_exists('integration', $data) ? $data['integration'] : null;

    }
}
