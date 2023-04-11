<?php

namespace App\Http\Service\Grid\Data\Factory;

use App\Http\Service\Grid\Config\Grid as ConfigGrid;
use App\Http\Service\Grid\Data\Grid;
use Exception;

class GridFactory
{

    /**
     * @throws Exception
     */
    public function create(ConfigGrid $config, array $data): Grid
    {
        $grid = new Grid();
        $query = (new GridLengthAwarePaginatorFactory($config, $data))->create();

        foreach ($query->items() as $item) {
            $row = (new GridRowFactory($config, (array)$item))->create();
            $grid->addRow($row);
        }

        return $grid;
    }

}
