<?php

namespace App\Http\Service\Grid\Config\Factory;

use App\Http\Service\Grid\Config\GridOrder;

class GridOrderFactory
{

    public function create(array $config): GridOrder
    {
        $order = new GridOrder;
        $order->setField($config['field']);
        $order->setType($config['type']);

        if (array_key_exists('model', $config)) {
            $order->setModel($config['model']);
        }

        return $order;
    }
}
