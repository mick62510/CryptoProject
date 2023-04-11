<?php

namespace App\Http\Service\Grid\Config\Factory;

use App\Http\Service\Grid\Config\Interface\BaseGridColumnInterface;

class BaseGridColumnFactory
{

    public function baseCreate(BaseGridColumnInterface $column, array $data, string $id): BaseGridColumnInterface
    {
        if (array_key_exists('model', $data)) {
            $column->setModel($data['model']);
        }
        if (array_key_exists('field', $data)) {
            $column->setField(array_key_exists('field', $data) ? $data['field'] : null);
        }
        $column->setId($id);
        $column->setLabel($data['label']);

        if (array_key_exists('ext', $data)) {
            $column->setExt($data['ext']);
        }

        return $column;
    }

}
