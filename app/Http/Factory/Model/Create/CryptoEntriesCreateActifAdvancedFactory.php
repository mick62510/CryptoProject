<?php

namespace App\Http\Factory\Model\Create;

use App\Http\Interface\ModelCreateFactoryInterface;
use App\Http\Repository\CryptoEntriesActifAdvancedRepository;
use App\Models\CryptoEntriesActifAdvanced;
use Illuminate\Support\Facades\Auth;

class CryptoEntriesCreateActifAdvancedFactory implements ModelCreateFactoryInterface
{
    public function create(mixed $data): CryptoEntriesActifAdvanced
    {
        $model = new CryptoEntriesActifAdvanced();
        $this->fill($model, $data);

        return $model;
    }

    public function fill(CryptoEntriesActifAdvanced $model, array $data): void
    {
        $model->user_id = $data['user_id'];
        $model->actif_code = $data['actif_code'];
        $model->value = $data['value'];
    }
}
