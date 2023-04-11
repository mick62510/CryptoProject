<?php

namespace App\Http\Service\Grid\Data\Factory;

use App\Http\Service\Grid\Config\Grid as ConfigGrid;
use App\Http\Service\Grid\Data\Pagination;

class PaginationFactory
{
    public function create(ConfigGrid $grid, array $data): Pagination
    {
        $pagination = new Pagination;
        $query = (new GridLengthAwarePaginatorFactory($grid, $data))->create();
        $pagination->setQuery($query);

        return $pagination;
    }
}
