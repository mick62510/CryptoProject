<?php

namespace App\Http\Interface;

use Illuminate\Database\Eloquent\Model;

interface ModelUpdateFactoryInterface
{
    public function update(Model $model, mixed $data): Model;

}
