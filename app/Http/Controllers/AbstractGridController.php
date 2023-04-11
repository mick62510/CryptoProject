<?php

namespace App\Http\Controllers;

use App\Http\Service\Grid\Config\Grid as ConfigGrid;
use App\Http\Service\Grid\Data\Factory\GridFactory;
use App\Http\Service\Grid\GridService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

abstract class AbstractGridController
{
    abstract public function getModel(): string;

    abstract public function getConfigGrid(): array;

    abstract public function getDataTransform(): string;

    private readonly GridService $service;

    public function __construct(GridService $gridService)
    {
        $this->service = $gridService;
        if (!define('VIEW_GRID', $this)) {
            dd("eazeza");
        }
    }

    public function index(): View
    {
        return view(static::VIEW_GRID, ['config' => json_encode($this->getConfig()->toArray())]);
    }

    private function getConfig(): ConfigGrid
    {
        return $this->service->createConfig($this->getConfigGrid(), $this->getModel(), $this->getDataTransform());
    }

    /**
     * @throws Exception
     */
    public function ajaxGridData(Request $request): JsonResponse
    {
        $data = $this->service->createData($this->getConfig(), $request->all())->toArray();
        $pagination = $this->service->createPagination($this->getConfig(), $request->all());

        return Response::json(['rows' => $data['rows'], 'pagination' => $pagination]);
    }

}
