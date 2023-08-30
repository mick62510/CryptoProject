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
use Illuminate\Support\Facades\Lang;

class CryptoEntriesService
{

    public function __construct(
        private readonly CryptoEntriesRepository           $repository,
        private readonly CryptoEntriesActifService         $actifService,
        private readonly CryptoEntriesDataService          $dataService,
        private readonly CryptoEntriesOprService           $oprService,
        private readonly CryptoEntriesAnalyzeService       $analyzeService,
        private readonly ChartService                      $chartService,
        private readonly CryptoEntriesActifAdvancedService $service
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
            'actif_advanced' => $this->service->regroupByActifCode()
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

    public function delete(int $cryptoEntriesId)
    {
        if ($model = $this->find($cryptoEntriesId)) {
            $this->repository->delete([$cryptoEntriesId]);
        }
    }

    public function getRadarActifDataByUserId(array $filters = []): array
    {
        $dataActifs = $this->repository->getAllByFilters(Auth::id(), $filters);

        return $this->chartService->getRadar($dataActifs['title'], 'Lose', $dataActifs['loose'], 'Win', $dataActifs['win']);
    }

    public function getDoughnutWinLooseBe(array $filters = []): array
    {
        $actifs = $this->getFilterActifs($filters);
        $activeBe = $this->getFilterBe($filters);

        $data = $this->repository->getWinLooseBe(Auth::id(), $actifs, $activeBe, $filters);
        $colors = [];
        $values = [];
        $labels = [];
        /** @var Object $actif */
        foreach ($data as $actif) {
            $labels[] = CryptoEntriesDataResultEnum::getByName($actif->result);
            $values[] = $actif->total;
        }
        foreach ($labels as $label) {
            if ($label === 'Be') {
                $colors[] = ChartService::COLOR_BE;
            } elseif ($label === 'Lose') {
                $colors[] = ChartService::COLOR_LOSE;
            } elseif ($label === 'Win') {
                $colors[] = ChartService::COLOR_WIN;
            }
        }

        return $this->chartService->getDoughnut($labels, $values, $colors);
    }

    private function getFilterActifs(array $filters = [])
    {
        return array_key_exists('actif', $filters) ? $filters['actif'] : [];
    }

    private function getFilterBe(array $filters = []): bool
    {
        if (array_key_exists('be', $filters)) {
            return $filters['be'] === 'true';
        }
        return true;
    }

    public function getRatioRiskReward(array $filters = []): array
    {
        $actifs = $this->getFilterActifs($filters);
        $valid = filter_var($filters['valid'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $be = $this->getFilterBe($filters);

        return $this->repository->getMinHeightMediumRiskReward(Auth::id(), $actifs, $be, $valid);
    }

    public function getLineNumberEntries(array $filters = []): array
    {
        $actifs = $this->getFilterActifs($filters);
        $activeBe = $this->getFilterBe($filters);

        $data = $this->repository->getNumberEntries(Auth::id(), actifs: $actifs, filters: $filters,activeBe: $activeBe)->all();
        $dataWin = $this->repository->getNumberEntries(Auth::id(), 'win', $actifs, $filters)->all();
        $dataLose = $this->repository->getNumberEntries(Auth::id(), 'loose', $actifs, $filters)->all();
        $dataBe = [];
        $labels = [];
        $dataAll = $this->transformKeyToInt($data);
        $dataWin = $this->transformKeyToInt($dataWin);
        $dataLose = $this->transformKeyToInt($dataLose);

        if ($activeBe) {
            $dataBe = $this->repository->getNumberEntries(Auth::id(), 'be', $actifs, $filters)->all();

            $dataBe = $this->transformKeyToInt($dataBe);
        }

        if (array_key_exists('date', $filters)) {
            $date = $filters['date'];
            $type = $date['type'];
            $value = $date['value'];

            if ($type === 'month') {
                $annee = $value['year'];
                $mois = $value['month'] + 1;
                $premierJour = Carbon::createFromDate($annee, $mois, 1);
                $nombreJours = $premierJour->daysInMonth;
                $labels = [];

                for ($jour = 1; $jour <= $nombreJours; $jour++) {
                    $date = Carbon::createFromDate($annee, $mois, $jour);
                    $labels[] = $date->dayName . " " . $date->day;
                    if (!array_key_exists($jour, $dataAll)) {
                        $dataAll[$jour] = 0;
                    }
                    if (!array_key_exists($jour, $dataWin)) {
                        $dataWin[$jour] = 0;
                    }
                    if (!array_key_exists($jour, $dataLose)) {
                        $dataLose[$jour] = 0;
                    }
                    if (!array_key_exists($jour, $dataBe) && $activeBe) {
                        $dataBe[$jour] = 0;
                    }
                }
            } elseif ($type === 'between') {
                $dateDebut = Carbon::parse($value[0]);
                $dateFin = Carbon::parse($value[1]);
                $labels = [];

                while ($dateDebut->lte($dateFin)) {

                    if (!array_key_exists($dateDebut->format('Ymd'), $dataAll)) {
                        $dataAll[$dateDebut->format('Ymd')] = 0;
                    }
                    if (!array_key_exists($dateDebut->format('Ymd'), $dataWin)) {
                        $dataWin[$dateDebut->format('Ymd')] = 0;
                    }
                    if (!array_key_exists($dateDebut->format('Ymd'), $dataLose)) {
                        $dataLose[$dateDebut->format('Ymd')] = 0;
                    }
                    if (!array_key_exists($dateDebut->format('Ymd'), $dataBe) && $activeBe) {
                        $dataBe[$dateDebut->format('Ymd')] = 0;
                    }
                    $labels[] = $dateDebut->monthName . " " . $dateDebut->dayName . " " . $dateDebut->day;
                    $dateDebut->addDay();
                }

            } elseif ($type === 'year') {
                $labels = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

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
                    if (!array_key_exists($m, $dataBe) && $activeBe) {
                        $dataBe[$m] = 0;
                    }
                }
            }
        }


        $dataAll = $this->ksortAndGetArrayValues($dataAll);
        $dataWin = $this->ksortAndGetArrayValues($dataWin);
        $dataLose = $this->ksortAndGetArrayValues($dataLose);

        $data = [
            [
                'label' => 'Nombre de trades',
                'data' => $dataAll,
                'backgroundColor' => ChartService::COLOR_ALL,
                'borderColor' => ChartService::COLOR_ALL,
                'borderDash' => [6]
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
        ];

        if ($activeBe) {
            $dataBe = $this->ksortAndGetArrayValues($dataBe);
            $data[] = [
                'label' => 'Trades Be',
                'data' => $dataBe,
                'backgroundColor' => ChartService::COLOR_BE,
                'borderColor' => ChartService::COLOR_BE,
            ];
        }

        return $this->chartService->getLine($labels, $data);
    }
    public function getRRValides(array $filters = []): array
    {
        $actifs = $this->getFilterActifs($filters);
        $data = $this->repository->getRRValides(Auth::id(), actifs: $actifs, filters: $filters,activeBe: false)->all();
        $labels = [];

        $dataAll = $this->transformKeyToInt($data);

        if (array_key_exists('date', $filters)) {
            $date = $filters['date'];
            $type = $date['type'];
            $value = $date['value'];

            if ($type === 'month') {
                $annee = $value['year'];
                $mois = $value['month'] + 1;
                $premierJour = Carbon::createFromDate($annee, $mois, 1);
                $nombreJours = $premierJour->daysInMonth;
                $labels = [];

                for ($jour = 1; $jour <= $nombreJours; $jour++) {
                    $date = Carbon::createFromDate($annee, $mois, $jour);
                    $labels[] = $date->dayName . " " . $date->day;
                    if (!array_key_exists($jour, $dataAll)) {
                        $dataAll[$jour] = 0;
                    }

                }
            } elseif ($type === 'between') {
                $dateDebut = Carbon::parse($value[0]);
                $dateFin = Carbon::parse($value[1]);
                $labels = [];

                while ($dateDebut->lte($dateFin)) {
                    if (!array_key_exists($dateDebut->format('Ymd'), $dataAll)) {
                        $dataAll[$dateDebut->format('Ymd')] = 0;
                    }

                    $labels[] = $dateDebut->monthName . " " . $dateDebut->dayName . " " . $dateDebut->day;
                    $dateDebut->addDay();
                }

            } elseif ($type === 'year') {
                $labels = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

                for ($m = 1; $m <= 12; $m++) {
                    if (!array_key_exists($m, $dataAll)) {
                        $dataAll[$m] = 0;
                    }
                }
            }
        }

        $dataAll = $this->ksortAndGetArrayValues($dataAll);

        $data = [
            [
                'label' => 'RR Validés',
                'data' => $dataAll,
                'backgroundColor' => ChartService::COLOR_ALL,
                'borderColor' => ChartService::COLOR_ALL,
            ],
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
