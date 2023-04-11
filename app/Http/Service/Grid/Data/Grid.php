<?php

namespace App\Http\Service\Grid\Data;

use App\Http\Service\Grid\Config\Interface\toArrayInterface;
use Illuminate\Database\Eloquent\Collection;

class Grid implements toArrayInterface
{
    protected Collection $rows;

    public function __construct()
    {
        $this->rows = new Collection;
    }

    public function getRows(): Collection
    {
        return $this->rows;
    }

    public function setRows(Collection $rows): void
    {
        $this->rows = $rows;
    }

    public function addRow(GridRow $row): void
    {
        $this->rows->add($row);
    }

    public function toArray(): array
    {
        $rows = [];
        /** @var GridRow $row */
        foreach ($this->rows as $row) {
            $rows[] = $row->toArray();
        }

        return [
            'rows' => $rows,
        ];
    }

}
