<?php

namespace App\Http\Service\Grid\Config;

use App\Http\Service\Grid\Config\Interface\GridColumnInterface;
use App\Http\Service\Grid\Config\Interface\toArrayInterface;
use Illuminate\Support\Collection;

class GridExtra implements toArrayInterface
{
    private string $label;
    private Collection $columns;

    public function toArray(): array
    {
        $columns = [];
        /** @var GridColumnInterface $column */
        foreach ($this->columns as $column) {
            $columns[] = $column->toArray();
        }

        return [
            'label' => $this->label,
            'columns' => $columns,
        ];
    }

    public function __construct()
    {
        $this->columns = new Collection;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getColumns(): Collection
    {
        return $this->columns;
    }

    public function setColumns(Collection $columns): void
    {
        $this->columns = $columns;
    }

    public function addColumn(GridColumnInterface $column): void
    {
        $this->columns->add($column);
    }

}
