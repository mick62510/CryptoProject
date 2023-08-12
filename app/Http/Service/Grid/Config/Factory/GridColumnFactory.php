<?php

namespace App\Http\Service\Grid\Config\Factory;

use App\Http\Service\Grid\Config\GridColumn;
use App\Http\Service\Grid\Config\Interface\GridColumnInterface;

class GridColumnFactory extends BaseGridColumnFactory
{

    public function create(string $id, array $column): GridColumnInterface
    {
        $gridColumn = new GridColumn;

        if ($id === 'actions') {
            $gridColumn->setId('actions');
            $gridColumn->setColumnActions(true);

            foreach ($column as $action) {
                $gridColumn->addAction((new GridColumnActionFactory)->create($action));
            }
        } else {
            if (array_key_exists('display', $column)) {
                $gridColumn->setDisplay($column['display']);
            }
            $gridColumn = $this->baseCreate($gridColumn, $column, $id);
        }

        return $gridColumn;
    }
}
