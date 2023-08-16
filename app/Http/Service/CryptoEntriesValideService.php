<?php

namespace App\Http\Service;

use App\Http\Repository\CryptoEntriesRepository;
use App\Models\CryptoEntries;
use App\Models\Enums\CryptoEntriesDataResultEnum;
use App\Models\Enums\CryptoEntriesTrendEnum;
use Illuminate\Http\UploadedFile;

class CryptoEntriesValideService
{

    public function __construct(private readonly FileManagerService $service, private readonly CryptoEntriesRepository $repository,)
    {

    }

    public function uploadFile(UploadedFile $file): string
    {
        return $this->service->uploadFileToTmp($file);
    }

    public function getCastsValues(): array
    {
        return [
            'result' => CryptoEntriesDataResultEnum::array(),
        ];
    }

    public function findById(int $id): ?CryptoEntries
    {
        return $this->repository->find($id);
    }

    public function update(int $id, array $data)
    {
        if ($model = $this->repository->find($id)) {
            $this->repository->update($model, $data);
        }
    }
    public function delete(int $cryptoEntriesId): void
    {
        if ($model = $this->repository->find($cryptoEntriesId)) {
            $this->repository->delete([$cryptoEntriesId]);
        }
    }
}
