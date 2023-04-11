<?php

namespace App\Http\Service\Grid\Data;

use App\Http\Service\Grid\Config\Interface\toArrayInterface;
use Illuminate\Database\Eloquent\Collection;

class GridExtraColumn implements toArrayInterface
{
    protected string $label;

    protected Collection $rows;

    public function __construct()
    {
        $this->rows = new Collection;
    }

    public function toArray(): array
    {
        $rows = [];
        /** @var GridExtraRow $column */
        foreach ($this->rows as $column) {
            $rows[] = $column->toArray();
        }

        return [
            'rows' => $rows,
            'label' => $this->label,
        ];
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getRows(): Collection
    {
        return $this->rows;
    }

    public function setRows(Collection $rows): void
    {
        $this->rows = $rows;
    }

    public function addRow(GridExtraRow $row): void
    {
        $this->rows->add($row);
    }

}
