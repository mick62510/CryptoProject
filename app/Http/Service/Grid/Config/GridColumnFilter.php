<?php

namespace App\Http\Service\Grid\Config;

use App\Http\Service\Grid\Config\Interface\GridColumnFilterInterface;
use App\Http\Service\Grid\Config\Interface\toArrayInterface;
use Closure;

class GridColumnFilter extends BaseGridColumn implements GridColumnFilterInterface, toArrayInterface
{
    protected array $values;
    protected string $type;
    protected ?string $ext = null;

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'values' => $this->values,
            'type' => $this->type,
        ];
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function setValues(array $values): void
    {
        $this->values = $values;
    }

    public function addValue(int $id, mixed $value): void
    {
        $this->values[$id] = $value;
    }

    public function __serialize(): array
    {
        $array = parent::__serialize();
        $array['values'] = $this->values;

        return $array;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
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
