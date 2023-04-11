<?php

namespace App\Http\Service\Grid\Config\Factory;

use App\Http\Service\Grid\Config\GridColumnFilter;
use App\Http\Service\Grid\Config\Interface\GridColumnFilterInterface;
use Illuminate\Database\Eloquent\Model;

class GridColumnFilterFactory extends BaseGridColumnFactory
{

    public function create(string $id, array $column, string $model): GridColumnFilterInterface
    {
        $gridColumnFilter = new GridColumnFilter;
        /** @var GridColumnFilterInterface $gridColumnFilter */
        $gridColumnFilter = $this->baseCreate($gridColumnFilter, $column, $id);
        $gridColumnFilter->setType($column['type']);

        if (array_key_exists('values', $column)) {
            /** @var Model $model */
            $model = new $model;

            if ($column['values'] instanceof \Closure) {
                $closure = $column['values'];
                $gridColumnFilter->setValues($closure($model));
            } else {
                $gridColumnFilter->setValues($column['values']);
            }

        }

        return $gridColumnFilter;
    }
}
