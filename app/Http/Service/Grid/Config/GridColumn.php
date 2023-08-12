<?php

namespace App\Http\Service\Grid\Config;

use App\Http\Service\Grid\Config\Interface\GridColumnInterface;
use Illuminate\Support\Collection;

class GridColumn extends BaseGridColumn implements GridColumnInterface
{
    private bool $display = true;
    private Collection $actions;
    private bool $columnActions = false;
    protected ?string $ext = null;

    public function __construct()
    {
        $this->actions = new Collection;
    }

    public function toArray(): array
    {
        $actions = [];
        /** @var GridColumnAction $action */
        foreach ($this->actions as $action) {
            $actions[] = $action->toArray();
        }

        return [
            'display' => $this->display,
            'columnActions' => $actions,
            'isColumnActions' => $this->columnActions,
            'id' => $this->id,
            'label' => $this->label,
        ];
    }

    public function __serialize(): array
    {
        $array = parent::__serialize();

        return $array;
    }

    public function isDisplay(): bool
    {
        return $this->display;
    }

    public function setDisplay(bool $display): void
    {
        $this->display = $display;
    }

    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function setActions(Collection $actions): void
    {
        $this->actions = $actions;
    }

    public function addAction(GridColumnAction $action): void
    {
        $this->actions->add($action);
    }

    public function isColumnActions(): bool
    {
        return $this->columnActions;
    }

    public function setColumnActions(bool $columnActions): void
    {
        $this->columnActions = $columnActions;
    }

    public function setExt(string $value): void
    {
        $this->ext = $value;
    }

    public function getExt(): ?string
    {
        return $this->ext;
    }

}
