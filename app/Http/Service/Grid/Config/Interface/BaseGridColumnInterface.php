<?php

namespace App\Http\Service\Grid\Config\Interface;

use Closure;

interface BaseGridColumnInterface
{

    public function setId(string $id): void;

    public function getId(): string;

    public function getField(): ?string;

    public function setField(string $field): void;

    public function getLabel(): ?string;

    public function setLabel(string $label): void;

    public function getModel(): string|Closure|null;

    public function setModel(?string $model): void;

    public function getValue(): mixed;

    public function setValue(mixed $value): void;

    public function setExt(string $value): void;

    public function getExt(): ?string;
}
