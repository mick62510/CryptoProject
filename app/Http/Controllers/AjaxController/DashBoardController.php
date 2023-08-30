<?php

namespace App\Http\Controllers\AjaxController;

use App\Http\Service\CryptoEntriesActifService;
use App\Http\Service\CryptoEntriesService;
use App\Http\Service\DashboardCacheService;
use App\Http\Service\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class DashBoardController
{
    public function __construct(
        private readonly CryptoEntriesService      $cryptoEntriesService,
        private readonly CryptoEntriesActifService $actifService,
        private readonly Request                   $request,
        private readonly DashboardCacheService     $cacheService,
        private readonly DashboardService          $dashboardService)
    {
    }

    public function radarActif(): JsonResponse
    {
        $filters = $this->request->all();
        $data = $this->cryptoEntriesService->getRadarActifDataByUserId($filters);

        return Response::json(['options' => $data['options'], 'data' => $data['data']]);
    }

    public function doughnutWinLoose(): JsonResponse
    {
        $filters = $this->request->all();
        $doughnut = $this->cryptoEntriesService->getDoughnutWinLooseBe($filters);

        return Response::json(['options' => $doughnut['options'], 'data' => $doughnut['data']]);
    }

    public function ratioRiskReward(): JsonResponse
    {
        $filters = $this->request->all();
        $data = $this->cryptoEntriesService->getRatioRiskReward($filters);

        return Response::json($data);
    }

    public function lineNumberEntries(): JsonResponse
    {
        $filters = $this->request->all();
        $data = $this->cryptoEntriesService->getLineNumberEntries($filters);

        return Response::json(['options' => $data['options'], 'data' => $data['data']]);
    }

    public function lineRREntries(): JsonResponse
    {
        $filters = $this->request->all();
        $data = $this->cryptoEntriesService->getRRValides($filters);

        return Response::json(['options' => $data['options'], 'data' => $data['data']]);
    }

    public function dataActif(): JsonResponse
    {
        return Response::json($this->actifService->getAllToSelect());
    }


    public function updateCache(): void
    {
        $filters = $this->request->all();

        $this->cacheService->createUpdate($filters);
    }

    public function getYears(): JsonResponse
    {
        return  Response::json($this->dashboardService->getYears());
    }

}
