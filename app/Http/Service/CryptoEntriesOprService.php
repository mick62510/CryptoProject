<?php

namespace App\Http\Service;

use App\Http\Repository\CryptoEntriesOprRepository;

class CryptoEntriesOprService
{
    public function __construct(private readonly CryptoEntriesOprRepository $repository)
    {
    }

    public function getCastsValues(): array
    {
        return $this->repository->getCastsValues();
    }
}
