<?php

namespace App\Http\Service\Grid\Config\Interface;

use Closure;

interface GridColumnFilterInterface extends BaseGridColumnInterface
{
    public function getValues(): array;

    public function setValues(array $values): void;

    public function addValue(int $id, mixed $value): void;

    public function getType(): string;

    public function setType(string $type): void;
}
