<?php

namespace App\Http\Repository;

use App\Http\Factory\Model\Create\CryptoEntriesCreateFactory;
use App\Http\Factory\Model\Update\CryptoEntriesUpdateFactory;
use App\Http\Interface\ModelCreateFactoryInterface;
use App\Http\Interface\ModelUpdateFactoryInterface;
use App\Http\Repository\trait\CastTrait;
use App\Models\CryptoEntries;

class CryptoEntriesRepository extends AbstractBaseRepository
{
    use CastTrait;

    public function getModel(): string
    {
        return CryptoEntries::class;
    }

    public function __construct(
        private readonly CryptoEntriesCreateFactory $createFactory,
        private readonly CryptoEntriesUpdateFactory $updateFactory,
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

    public function getAllByResult(?string $result = null)
    {
        return CryptoEntries::where('result', '=', $result)->paginate(10);
    }
}
