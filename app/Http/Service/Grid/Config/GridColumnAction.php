<?php

namespace App\Http\Service\Grid\Config;

use App\Http\Service\Grid\Config\Interface\toArrayInterface;

class GridColumnAction implements toArrayInterface
{
    private string $label;
    private string $route;
    private array $params;

    public function getLabel(): string
    {
        return $this->label;
    }

    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'route' => $this->route,
            'params' => $this->params,
        ];
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function setRoute(string $route): void
    {
        $this->route = $route;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function setParams(array $params): void
    {
        $this->params = $params;
    }

}
