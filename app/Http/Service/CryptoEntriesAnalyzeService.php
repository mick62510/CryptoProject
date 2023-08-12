<?php

namespace App\Http\Service;

use App\Http\Repository\CryptoEntriesAnalyzeRepository;

class CryptoEntriesAnalyzeService
{
    public function __construct(private readonly CryptoEntriesAnalyzeRepository $repository)
    {
    }

    public function getCastsValues(): array
    {
        return $this->repository->getCastsValues();
    }
}
