<?php

namespace App\Http\Controllers\AjaxController;

use App\Http\Service\CryptoEntriesActifService;
use App\Http\Service\CryptoEntriesService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class DashBoardController
{
    public function __construct(private readonly CryptoEntriesService      $cryptoEntriesService,
                                private readonly CryptoEntriesActifService $actifService,
                                private readonly Request                   $request)
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

    public function dataActif(): JsonResponse
    {
        return Response::json($this->actifService->getAllToSelect());
    }
}
