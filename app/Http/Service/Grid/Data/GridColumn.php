<?php

namespace App\Http\Service\Grid\Data;

use App\Http\Service\Grid\Config\Interface\toArrayInterface;

class GridColumn implements toArrayInterface
{
    protected mixed $value;

    protected string $id;

    protected bool $display = true;

    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'id' => $this->id,
            'display' => $this->display,
        ];
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function isDisplay(): bool
    {
        return $this->display;
    }

    public function setDisplay(bool $display): void
    {
        $this->display = $display;
    }

}
