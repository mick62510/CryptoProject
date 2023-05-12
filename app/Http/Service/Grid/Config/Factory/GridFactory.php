<?php

namespace App\Http\Service\Grid\Config\Factory;

use App\Http\Service\Grid\Config\Grid;
use App\Http\Service\Grid\Config\GridExtra;
use App\Http\Service\Grid\Config\GridWhere;
use Illuminate\Database\Eloquent\Model;

class GridFactory
{

    public function create(array $config, string $model, string $dataTransform): Grid
    {
        $grid = new Grid;
        $grid->setModel($model);
        $grid->setDataTransform($dataTransform);

        if (array_key_exists('columns', $config)) {
            foreach ($config['columns'] as $id => $column) {
                $gridColumn = (new GridColumnFactory)->create($id, $column);
                $grid->addColumn($gridColumn);
            }
        }

        if (array_key_exists('filters', $config)) {
            foreach ($config['filters'] as $id => $column) {
                $gridColumn = (new GridColumnFilterFactory)->create($id, $column, $model);
                $grid->addFilter($gridColumn);
            }
        }
        if (array_key_exists('extra', $config)) {
            foreach ($config['extra'] as $id => $extra) {

                $gridExtra = new GridExtra;
                $gridExtra->setLabel($extra['label']);

                foreach ($extra['columns'] as $columnId => $column) {
                    $gridExtra->addColumn((new GridColumnFactory)->create($columnId, $column));
                }

                $grid->addExtra($gridExtra);
            }
        }
        if (array_key_exists('where', $config)) {
            foreach ($config['where'] as $where) {
                $where = (new GridWhereFactory)->create($where);
                $grid->addWhere($where);
            }
        }
        if (array_key_exists('orders', $config)) {
            foreach ($config['orders'] as $order) {
                $orderClass = (new GridOrderFactory())->create($order);
                $grid->addOrder($orderClass);
            }
        }

        return $grid;
    }

}
