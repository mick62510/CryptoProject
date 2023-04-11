<?php

namespace App\Http\Service\Grid\Data;

use App\Http\Service\Grid\Config\Interface\toArrayInterface;
use Illuminate\Support\Collection;

class GridRow implements toArrayInterface
{
    protected Collection $columns;

    protected Collection $extraColumns;

    protected int $rowId;

    protected array $actions = [];

    public function __construct()
    {
        $this->columns = new Collection;
        $this->extraColumns = new Collection;
    }

    public function toArray(): array
    {
        $columns = [];
        /** @var GridColumn $column */
        foreach ($this->columns as $column) {
            $columns[] = $column->toArray();
        }
        $extras = [];
        /** @var GridExtraColumn $column */
        foreach ($this->extraColumns as $extraColumn) {
            $extras[] = $extraColumn->toArray();
        }

        return [
            'columns' => $columns,
            'rowId' => $this->rowId,
            'extraColumns' => $extras,
            'actions' => $this->actions,
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

    public function addColumn(GridColumn $column): void
    {
        $this->columns->add($column);
    }

    public function getExtraColumns(): Collection
    {
        return $this->extraColumns;
    }

    public function setExtraColumns(Collection $extraColumns): void
    {
        $this->extraColumns = $extraColumns;
    }

    public function addExtraColumn(GridExtraColumn $column): void
    {
        $this->extraColumns->add($column);
    }

    public function getActions(): array
    {
        return $this->actions;
    }

    public function setActions(array $actions): void
    {
        $this->actions = $actions;
    }

    /**
     * @return int
     */
    public function getRowId(): int
    {
        return $this->rowId;
    }

    /**
     * @param int $rowId
     */
    public function setRowId(int $rowId): void
    {
        $this->rowId = $rowId;
    }

}
