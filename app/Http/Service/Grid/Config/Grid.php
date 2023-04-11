<?php

namespace App\Http\Service\Grid\Config;

use App\Http\Service\Grid\Config\Interface\GridColumnFilterInterface;
use App\Http\Service\Grid\Config\Interface\GridColumnInterface;
use App\Http\Service\Grid\Config\Interface\toArrayInterface;
use Illuminate\Support\Collection;

class Grid implements toArrayInterface
{
    public Collection $columns;
    public Collection $filters;
    public Collection $extra;
    public string $model;
    public string $dataTransform;
    public Collection $wheres;

    public function __construct()
    {
        $this->columns = new Collection;
        $this->filters = new Collection;
        $this->extra = new Collection;
        $this->wheres = new Collection;
    }

    public function toArray(): array
    {
        $columns = [];
        /** @var GridColumnInterface $column */
        foreach ($this->columns as $column) {
            $columns[] = $column->toArray();
        }
        $filters = [];
        /** @var GridColumnFilterInterface $filter */
        foreach ($this->filters as $filter) {
            $filters[] = $filter->toArray();
        }
        $extras = [];
        /** @var GridColumnFilterInterface $filter */
        foreach ($this->extra as $extra) {
            $extras[] = $extra->toArray();
        }

        return [
            'columns' => $columns,
            'filters' => $filters,
            'extra' => $extras,
        ];
    }

    public function getColumns(): Collection
    {
        return $this->columns;
    }

    public function setColumns(Collection $columns): void
    {
        $this->columns = $columns;
    }

    public function getFilters(): Collection
    {
        return $this->filters;
    }

    public function setFilters(Collection $filters): void
    {
        $this->filters = $filters;
    }

    public function addFilter(GridColumnFilterInterface $columnFilter)
    {
        $this->filters->add($columnFilter);
    }

    public function getExtra(): Collection
    {
        return $this->extra;
    }

    public function setExtra(?Collection $extra): void
    {
        $this->extra = $extra;
    }

    public function addColumn(GridColumnInterface $column): void
    {
        $this->columns->add($column);
    }

    public function addExtra(GridExtra $extra)
    {
        $this->extra->add($extra);
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function getDataTransform(): string
    {
        return $this->dataTransform;
    }

    public function setDataTransform(string $dataTransform): void
    {
        $this->dataTransform = $dataTransform;
    }

    public function getWheres(): Collection
    {
        return $this->wheres;
    }

    public function setWheres(Collection $wheres): void
    {
        $this->wheres = $wheres;
    }

    public function addWhere(GridWhere $gridWhere): void
    {
        $this->wheres->add($gridWhere);
    }

}
