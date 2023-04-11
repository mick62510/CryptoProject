<?php

namespace App\Http\Factory\Model\Create;

use App\Http\Interface\ModelCreateFactoryInterface;
use App\Http\Repository\CryptoEntriesActifRepository;
use App\Models\CryptoEntries;
use App\Models\CryptoEntriesActif;
use App\Models\CryptoEntriesAnalyze;
use App\Models\CryptoEntriesData;
use App\Models\CryptoEntriesOpr;
use App\Models\CryptoEntriesZone;
use Illuminate\Filesystem\FilesystemManager;

class CryptoEntriesCreateFactory implements ModelCreateFactoryInterface
{
    public function __construct(
        private readonly CryptoEntriesActifRepository      $actifRepository,
        private readonly CryptoEntriesCreateDataFactory    $factoryData,
        private readonly CryptoEntriesCreateOprFactory     $factoryOpr,
        private readonly CryptoEntriesCreateAnalyzeFactory $factoryAnalyze,
        private readonly CryptoEntriesCreateZoneFactory    $zoneFactory,

    )
    {
    }

    public function create(mixed $data): CryptoEntries
    {
        $model = new CryptoEntries;
        $model->date = $data['date'];
        $model->user_id = $data['user_id'];
        $model->trend = $data['trend'];
        $model->trend_type = $data['trend_type'];
        $model->risk_reward = $data['risk_reward'];
        $model->actif_code = $this->getActif($data['actif_code'])->code;
        $model->data()->associate($this->createData($data));
        $model->opr()->associate($this->createOpr($data));
        $model->analyze()->associate($this->createAnalyze($data));
        $model->zone()->associate($this->createZone($data));

        return $model;
    }

    private function getActif(string $actifCode): ?CryptoEntriesActif
    {
        $model = $this->actifRepository->find($actifCode);
        $model->save();

        return $model;
    }

    public function createData(array $data): CryptoEntriesData
    {
        $model = $this->factoryData->create($data);
        $model->save();

        return $model;
    }

    private function createOpr(array $data): CryptoEntriesOpr
    {
        $model = $this->factoryOpr->create($data);
        $model->save();

        return $model;
    }

    private function createAnalyze(array $data): CryptoEntriesAnalyze
    {
        $model = $this->factoryAnalyze->create($data);
        $model->save();

        return $model;
    }

    private function createZone(array $data): CryptoEntriesZone
    {
        $model = $this->zoneFactory->create($data);
        $model->save();

        return $model;
    }
}
