<?php

namespace App\Http\Service\Grid\Config\Factory;

use App\Http\Service\Grid\Config\GridWhere;

class GridWhereFactory
{
    public function create(array $data): GridWhere
    {
        $where = new GridWhere;
        $where->setField($data['field']);
        $where->setValue($data['value']);

        if (array_key_exists('model', $data)) {
            $where->setModel($data['model']);
        }

        return $where;
    }

}
