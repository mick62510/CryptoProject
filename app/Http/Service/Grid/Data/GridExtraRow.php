<?php

namespace App\Http\Service\Grid\Data;

use App\Http\Service\Grid\Config\Interface\toArrayInterface;

class GridExtraRow implements toArrayInterface
{
    protected string $label;
    protected ?string $value = null;
    protected ?string $ext = null;

    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'value' => $this->value,
            'ext' => $this->ext,
        ];
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }

    public function getExt(): ?string
    {
        return $this->ext;
    }

    public function setExt(?string $ext): void
    {
        $this->ext = $ext;
    }

}
