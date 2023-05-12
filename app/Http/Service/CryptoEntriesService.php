<?php

namespace App\Http\Service;

use App\Http\Factory\Model\Create\CryptoEntriesCreateFactory;
use App\Http\Repository\CryptoEntriesRepository;
use App\Models\CryptoEntries;
use App\Models\Enums\CryptoEntriesDataResultEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class CryptoEntriesService
{

    public function __construct(
        private readonly CryptoEntriesRepository     $repository,
        private readonly CryptoEntriesActifService   $actifService,
        private readonly CryptoEntriesDataService    $dataService,
        private readonly CryptoEntriesOprService     $oprService,
        private readonly CryptoEntriesAnalyzeService $analyzeService,
        private readonly ChartService                $chartService,
    )
    {

    }

    public function create(array $data): Model
    {
        $model = $this->repository->create($data);
        $model->save();

        return $model;
    }

    public function newModel(): Model
    {
        return $this->repository->new();
    }

    public function getCastsValues(): array
    {
        return [
            'entries' => $this->repository->getCastsValues(),
            'actif' => $this->actifService->allToArray(),
            'data' => $this->dataService->getCastsValues(),
            'opr' => $this->oprService->getCastsValues(),
            'analyze' => $this->analyzeService->getCastsValues(),
        ];
    }

    public function uploadFile(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid() . '.' . $extension;
        $location = 'images/tmp';
        $file->move(storage_path('app/public/' . $location), $filename);

        return $location . '/' . $filename;
    }

    public function getItemsNotValidated()
    {
        return $this->repository->getAllByResult();
    }

    public function find(int $id): ?CryptoEntries
    {
        return $this->repository->find($id);
    }

    public function update(array $data)
    {
        if ($model = $this->find($data['id'])) {
            $this->repository->update($model, $data);
        }
    }

    public function getRadarActifDataByUserId(array $filters = []): array
    {
        $actifs = array_key_exists('actif', $filters) ? $filters['actif'] : [];
        $dataActifs = $this->repository->getAllGroupByActifFilterUserId(Auth::id(), $actifs);

        return $this->chartService->getRadar($dataActifs['title'], 'Lose', $dataActifs['loose'], 'Win', $dataActifs['win']);
    }

    public function getDoughnutWinLooseBe(array $filters = []): array
    {
        $actifs = array_key_exists('actif', $filters) ? $filters['actif'] : [];
        $data = $this->repository->getWinLooseBe(Auth::id(), $actifs);

        $values = [];
        $labels = [];
        /** @var Object $actif */
        foreach ($data as $actif) {

            $labels[] = CryptoEntriesDataResultEnum::getByName($actif->result);
            $values[] = $actif->total;
        }

        return $this->chartService->getDoughnut($labels, $values, [ChartService::COLOR_WIN, ChartService::COLOR_LOSE, ChartService::COLOR_BE]);
    }

    public function getRatioRiskReward(array $filters = []): array
    {
        $actifs = array_key_exists('actif', $filters) ? $filters['actif'] : [];

        return $this->repository->getMinHeightMediumRiskReward(Auth::id(), $actifs);
    }

    public function getLineNumberEntries(array $filters = []): array
    {
        //TODO faire les 12 derniers mois.

        $actifs = array_key_exists('actif', $filters) ? $filters['actif'] : [];
        $labels = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
        $data = $this->repository->getNumberEntries(Auth::id(), actifs: $actifs)->all();
        $dataWin = $this->repository->getNumberEntries(Auth::id(), 'win', $actifs)->all();
        $dataLose = $this->repository->getNumberEntries(Auth::id(), 'lose', $actifs)->all();
        $dataBe = $this->repository->getNumberEntries(Auth::id(), 'be', $actifs)->all();
        $dataAll = $this->transformKeyToInt($data);
        $dataWin = $this->transformKeyToInt($dataWin);
        $dataBe = $this->transformKeyToInt($dataBe);

        for ($m = 1; $m <= 12; $m++) {
            if (!array_key_exists($m, $dataAll)) {
                $dataAll[$m] = 0;
            }
            if (!array_key_exists($m, $dataWin)) {
                $dataWin[$m] = 0;
            }
            if (!array_key_exists($m, $dataLose)) {
                $dataLose[$m] = 0;
            }
            if (!array_key_exists($m, $dataBe)) {
                $dataBe[$m] = 0;
            }
        }

        $dataAll = $this->ksortAndGetArrayValues($dataAll);
        $dataWin = $this->ksortAndGetArrayValues($dataWin);
        $dataLose = $this->ksortAndGetArrayValues($dataLose);
        $dataBe = $this->ksortAndGetArrayValues($dataBe);

        $data = [
            [
                'label' => 'Nombre de trades',
                'data' => $dataAll,
                'backgroundColor' => ChartService::COLOR_ALL,
                'borderColor' => ChartService::COLOR_ALL,
            ],
            [
                'label' => 'Trades WIN',
                'data' => $dataWin,
                'backgroundColor' => ChartService::COLOR_WIN,
                'borderColor' => ChartService::COLOR_WIN,
            ],
            [
                'label' => 'Trades Lost',
                'data' => $dataLose,
                'backgroundColor' => ChartService::COLOR_LOSE,
                'borderColor' => ChartService::COLOR_LOSE,
            ],
            [
                'label' => 'Trades Be',
                'data' => $dataBe,
                'backgroundColor' => ChartService::COLOR_BE,
                'borderColor' => ChartService::COLOR_BE,
            ]
        ];

        return $this->chartService->getLine($labels, $data);
    }

    private function transformKeyToInt(array $data): array
    {
        $return = [];

        foreach ($data as $key => $value) {
            $return[(int)$key] = $value;
        }
        return $return;
    }

    private function ksortAndGetArrayValues(array $data): array
    {
        ksort($data);

        return array_values($data);
    }


}
