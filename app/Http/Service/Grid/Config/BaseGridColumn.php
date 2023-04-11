<?php

namespace App\Http\Service\Grid\Config;

use Closure;

class BaseGridColumn
{
    public string $id;
    public ?string $field = null;
    public ?string $label = null;
    public null|string|Closure $model = null;
    public mixed $value = null;

    public function __serialize(): array
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getField(): ?string
    {
        return $this->field;
    }

    public function setField(?string $field): void
    {
        $this->field = $field;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }

    public function getModel(): string|Closure|null
    {
        return $this->model;
    }

    /**
     * @param Closure|string|null $model
     */
    public function setModel(string|Closure|null $model): void
    {
        $this->model = $model;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }

}
