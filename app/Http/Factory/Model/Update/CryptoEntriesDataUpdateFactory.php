<?php

namespace App\Http\Factory\Model\Update;

use App\Http\Interface\ModelUpdateFactoryInterface;
use Illuminate\Database\Eloquent\Model;

class CryptoEntriesDataUpdateFactory implements ModelUpdateFactoryInterface
{
    public function update(Model $model, mixed $data): Model
    {
        return $model;
    }

}
