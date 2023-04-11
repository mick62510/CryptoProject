<?php

namespace App\Http\Service\Grid;

use App\Http\Service\Grid\Config\Factory\GridFactory;
use App\Http\Service\Grid\Config\Grid as ConfigGrid;
use \App\Http\Service\Grid\Data\Factory\GridFactory as DataGridFactory;
use App\Http\Service\Grid\Data\Factory\PaginationFactory;
use Exception;

class GridService
{
    public function __construct(private readonly GridFactory $factory, private readonly DataGridFactory $dataGrid, private PaginationFactory $paginationFactory)
    {
    }

    public function createConfig(array $config, string $model, string $dataTransform): ConfigGrid
    {
        return $this->factory->create($config, $model, $dataTransform);
    }

    /**
     * @throws Exception
     */
    public function createData(ConfigGrid $grid, array $data): Data\Grid
    {
        return $this->dataGrid->create($grid, $data);
    }

    public function createPagination(ConfigGrid $grid, array $data): array
    {

        $pagination = $this->paginationFactory->create($grid, $data)->getQuery();

        return [
            'total' => $pagination->total(),
            'per_page' => $pagination->perPage(),
            'current_page' => $pagination->currentPage(),
            'last_page' => $pagination->lastPage(),
            'from' => $pagination->firstItem(),
            'to' => $pagination->lastItem(),
        ];
    }

}
