<?php

namespace App\Http\Service\Grid\Data\Factory;

use App\Http\Service\Grid\Config\Grid as ConfigGrid;
use App\Http\Service\Grid\Config\GridColumn;
use App\Http\Service\Grid\Config\GridColumnAction;
use App\Http\Service\Grid\Config\GridExtra;
use App\Http\Service\Grid\Config\GridExtraColumn;
use App\Http\Service\Grid\Data\GridColumn as DataColumn;
use App\Http\Service\Grid\Data\GridExtraColumn as DataExtraColumn;
use App\Http\Service\Grid\Data\GridExtraRow;
use App\Http\Service\Grid\Data\GridRow;
use App\Http\Service\Grid\Transform\CryptoEntriesNotValidated;
use Illuminate\Support\Collection;

class GridRowFactory
{

    public function __construct(private ConfigGrid $grid, private array $data)
    {
        if ($transform = $this->grid->getDataTransform()) {
            $transform = new $transform($data);
            $this->data = $transform->toArray();
        }
    }

    public function create(): GridRow
    {
        $row = new GridRow;
        $row->setRowId($this->data['id']);

        /** @var GridColumn $column */
        foreach ($this->grid->getColumns() as $column) {
            if ($column->getId() === 'actions') {
                $actions = $this->initActions($column->getActions());
                $row->setActions($actions);
            } else {
                $dataColumn = $this->createDataColumn($column->getField(), $column->getId(), $column->isDisplay());
                $row->addColumn($dataColumn);
            }
        }

        /** @var GridExtra $extra */
        foreach ($this->grid->getExtra() as $extra) {
            $dataExtraColumn = new DataExtraColumn();
            $dataExtraColumn->setLabel($extra->getLabel());
            /** @var GridExtraColumn $extraColumn */
            foreach ($extra->getColumns() as $extraColumn) {
                $dataExtraRow = $this->createGridExtraRow($extraColumn->getField(), $extraColumn->getLabel(), $extraColumn->getExt());
                $dataExtraColumn->addRow($dataExtraRow);
            }
            $row->addExtraColumn($dataExtraColumn);
        }

        return $row;
    }

    private function createGridExtraRow(string $field, string $label, ?string $extra = null): GridExtraRow
    {
        $dataExtraRow = new GridExtraRow;

        $dataExtraRow->setValue(array_key_exists($field, $this->data) ? $this->data[$field] : null);
        $dataExtraRow->setLabel($label);
        $dataExtraRow->setExt($extra);

        return $dataExtraRow;
    }

    private function createDataColumn(string $field, string $id, bool $display): DataColumn
    {
        $dataColumn = new DataColumn;

        $value = array_key_exists($field, $this->data) ? $this->data[$field] : null;
        $dataColumn->setValue($value);
        $dataColumn->setId($id);
        $dataColumn->setDisplay($display);

        return $dataColumn;
    }

    private function initActions(Collection $collection): array
    {
        $actions = [];
        /** @var GridColumnAction $action */
        foreach ($collection as $action) {
            $params = [];
            foreach ($action->getParams() as $param) {
                $params[$param] = $this->data[$param];
            }
            $route = route($action->getRoute(), $params);
            $actions[] = sprintf($action->getLabel(), $route);
        }

        return $actions;
    }

}
