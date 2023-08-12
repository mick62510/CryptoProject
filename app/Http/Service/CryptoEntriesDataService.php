<?php

namespace App\Http\Service;

use App\Http\Repository\CryptoEntriesDataRepository;
use App\Models\CryptoEntriesData;

class CryptoEntriesDataService
{

    public function __construct(private readonly CryptoEntriesDataRepository $repository)
    {
    }

    public function getCastsValues(): array
    {
        return $this->repository->getCastsValues();
    }
}
