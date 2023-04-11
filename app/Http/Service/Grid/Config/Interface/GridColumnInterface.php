<?php

namespace App\Http\Service\Grid\Config\Interface;

use App\Http\Service\Grid\Config\GridColumnAction;
use Closure;
use Illuminate\Support\Collection;

interface GridColumnInterface extends BaseGridColumnInterface, toArrayInterface
{
    public function isDisplay(): bool;

    public function setDisplay(bool $display): void;

    public function getActions(): Collection;

    public function setActions(Collection $actions): void;

    public function addAction(GridColumnAction $action): void;

    public function isColumnActions(): bool;

    public function setColumnActions(bool $columnActions): void;

}
