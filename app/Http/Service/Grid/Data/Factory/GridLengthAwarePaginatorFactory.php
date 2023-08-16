<?php

namespace App\Http\Service\Grid\Data\Factory;

use App\Http\Service\Grid\Config\Grid as ConfigGrid;
use App\Http\Service\Grid\Config\GridColumn;
use App\Http\Service\Grid\Config\GridColumnFilter;
use App\Http\Service\Grid\Config\GridExtra;
use App\Http\Service\Grid\Config\GridExtraColumn;
use App\Http\Service\Grid\Config\GridOrder;
use App\Http\Service\Grid\Config\GridWhere;
use App\Models\CryptoEntries;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class GridLengthAwarePaginatorFactory
{

    private Model $primaryModelReflect;

    private array $joinCreated = [];

    public function __construct(private readonly ConfigGrid $config, private readonly array $data)
    {
        $this->primaryModelReflect = new ($this->config->getModel());
    }

    public function create(): LengthAwarePaginator
    {
        $model = new ($this->config->getModel());
        $table = $model->getTable();
        $builder = DB::table($table);

        $this->initSelect($builder);
        $this->initWhere($this->config->getWheres(), $builder);

        if (array_key_exists('filters', $this->data)) {
            $this->initFilters($builder);
        }

        $this->initColumnsJoin($builder);
        $this->initExtrasJoin($builder);
        $this->initOrderBy($this->config->getOrders(), $builder);

        return $builder->paginate(10);
    }

    private function initSelect(Builder $paginator): void
    {
        $select = [];
        /** @var GridColumn $column */
        foreach ($this->config->getColumns() as $column) {
            if ($column->getField()) {
                if ($column->getModel()) {
                    $table = $this->getModelTable($column->getModel());
                } else {
                    $table = $this->primaryModelReflect->getTable();
                }
                $select[] = $table . '.' . $column->getField();
            }
        }

        /** @var GridExtra $extra */
        foreach ($this->config->getExtra() as $extra) {
            /** @var GridExtraColumn $column */
            foreach ($extra->getColumns() as $column) {
                if ($column->getField()) {
                    if ($column->getModel()) {
                        $table = $this->getModelTable($column->getModel());
                    } else {
                        $table = $this->primaryModelReflect->getTable();
                    }
                    $select[] = $table . '.' . $column->getField();
                }
            }
        }

        $paginator->select($select);
    }

    private function initFilters(Builder $paginator): void
    {
        foreach ($this->data['filters'] as $id => $value) {
            /** @var GridColumnFilter $columnToFilter */
            $columnToFilter = $this->config->getFilters()->firstWhere('id', '=', $id);

            if ($columnToFilter->getModel()) {
                $modelString = $columnToFilter->getModel();
                $this->initJoin($paginator, $modelString);
                $paginator->where($this->getOwnerKeyName($modelString), '=', $value);
            } else {
                $modelString = $this->primaryModelReflect->getTable();
                $paginator->where($modelString . '.' . $columnToFilter->getField(), '=', $value);
            }
        }
    }

    private function initColumnsJoin(Builder $DB): void
    {
        /** @var GridColumn $column */
        foreach ($this->config->getColumns() as $column) {
            if ($model = $column->getModel()) {
                $this->initJoin($DB, $model);
            }
        }
    }

    private function initOrderBy(Collection $collection, Builder $builder): void
    {
        /** @var GridOrder $item */
        foreach ($collection->all() as $item) {
            if ($model = $item->getModel()) {
                $class = $this->getModelTable($model);
            } else {
                $class = $this->primaryModelReflect->getTable();
            }
            $builder->orderBy($class . '.' . $item->getField(), $item->getType());
        }
    }

    private function initWhere(Collection $collection, Builder $builder): void
    {
        /** @var GridWhere $item */
        foreach ($collection->all() as $item) {
            if ($model = $item->getModel()) {
                $class = $this->getModelTable($model);
            } else {
                $class = $this->primaryModelReflect->getTable();
            }

            if ($item->getValue() === 'not_null') {
                $builder->whereNotNull($class . '.' . $item->getField());
            } elseif ($item->getValue() === 'null') {
                $builder->whereNull($class . '.' . $item->getField());
            } else {
                $builder->where($class . '.' . $item->getField(), '=', $item->getValue());
            }
        }
    }

    private function initExtrasJoin(Builder $DB): void
    {
        /** @var GridExtra $extra */
        foreach ($this->config->getExtra() as $extra) {
            /** @var GridExtraColumn $column */
            foreach ($extra->getColumns() as $column) {
                if ($model = $column->getModel()) {
                    $this->initJoin($DB, $model);
                }
            }
        }
    }

    private function initJoin(Builder $DB, string $model): void
    {
        if ($this->canCreateJoin($model)) {
            $table = $this->getModelTable($model);
            $DB->leftJoin($table, $this->getForeignKeyName($model), '=', $this->getOwnerKeyName($model));
            $this->addJoinCreated($model);
        }
    }

    private function getModelTable(string $model): string
    {
        return $this->primaryModelReflect->{$model}()->getModel()->getTable();
    }

    private function getOwnerKeyName(string $model): string
    {
        return $this->primaryModelReflect->{$model}()->getQualifiedOwnerKeyName();
    }

    private function getForeignKeyName(string $model): string
    {
        return $this->primaryModelReflect->{$model}()->getQualifiedForeignKeyName();
    }

    private function addJoinCreated(string $model): void
    {
        $this->joinCreated[] = $model;
    }

    private function canCreateJoin(string $model): bool
    {
        if (in_array($model, $this->joinCreated, true)) {
            return false;
        }

        return true;
    }

}
