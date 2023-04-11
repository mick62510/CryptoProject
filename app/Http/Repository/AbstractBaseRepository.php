<?php

namespace App\Http\Repository;

use App\Http\Interface\ModelCreateFactoryInterface;
use App\Http\Interface\ModelUpdateFactoryInterface;
use App\Models\CryptoEntries;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractBaseRepository
{
    protected Model $model;

    abstract public function getModelCreateFactory(): ModelCreateFactoryInterface;

    abstract public function getModelUpdateFactory(): ModelUpdateFactoryInterface;

    abstract public function getModel(): string;

    public function __construct()
    {
        $model = $this->getModel();
        $this->model = new $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->getModel()::find($id);
    }

    public function getByIds(array $ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    public function new(): Model
    {
        return $this->model->newInstance();
    }

    public function delete($ids)
    {
        return $this->model->destroy($ids);
    }

    public function getCount(): int
    {
        return $this->model->count();
    }

    public function update(Model $model, mixed $data): Model
    {
        unset($data['_token']);
        if (array_key_exists('id', $data)) {
            unset($data['id']);
        }

        $model = $this->getModelUpdateFactory()->update($model, $data);
        $model->save();

        return $model;
    }

    public function create(mixed $data): Model
    {
        $model = $this->getModelCreateFactory()->create($data);
        $model->save();

        return $model;
    }
}
