<?php

namespace App\Http\Service;

use App\Http\Factory\Model\Create\CryptoEntriesCreateFactory;
use App\Http\Repository\CryptoEntriesRepository;
use App\Models\CryptoEntries;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\UploadedFile;

class CryptoEntriesService
{
    public function __construct(
        private readonly CryptoEntriesRepository     $repository,
        private readonly CryptoEntriesActifService   $actifService,
        private readonly CryptoEntriesDataService    $dataService,
        private readonly CryptoEntriesOprService     $oprService,
        private readonly CryptoEntriesAnalyzeService $analyzeService,
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

}
