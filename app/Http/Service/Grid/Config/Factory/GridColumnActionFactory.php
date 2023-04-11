<?php

namespace App\Http\Service\Grid\Config\Factory;

use App\Http\Service\Grid\Config\GridColumnAction;

class GridColumnActionFactory
{

    public function create(array $column): GridColumnAction
    {
        $action = new GridColumnAction;
        $action->setLabel($column['label']);
        $action->setRoute($column['route']);
        $action->setParams($column['params']);

        return $action;
    }
}
