<?php

namespace App\Http\Repository;

use App\Http\Factory\Model\Create\CryptoEntriesCreateAnalyzeFactory;
use App\Http\Factory\Model\Update\CryptoEntriesAnalyzeUpdateFactory;
use App\Http\Interface\ModelCreateFactoryInterface;
use App\Http\Interface\ModelUpdateFactoryInterface;
use App\Http\Repository\trait\CastTrait;
use App\Models\CryptoEntriesAnalyze;

class CryptoEntriesAnalyzeRepository extends AbstractBaseRepository
{
    use CastTrait;

    public function getModel(): string
    {
        return CryptoEntriesAnalyze::class;
    }

    public function __construct(
        private readonly CryptoEntriesCreateAnalyzeFactory $createFactory,
        private readonly CryptoEntriesAnalyzeUpdateFactory $updateFactory,
    )
    {
        parent::__construct();
    }

    public function getModelCreateFactory(): ModelCreateFactoryInterface
    {
        return $this->createFactory;
    }

    public function getModelUpdateFactory(): ModelUpdateFactoryInterface
    {
        return $this->updateFactory;
    }

}
