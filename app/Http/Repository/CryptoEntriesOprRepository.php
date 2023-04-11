<?php

namespace App\Http\Repository;

use App\Http\Factory\Model\Create\CryptoEntriesCreateOprFactory;
use App\Http\Factory\Model\Update\CryptoEntriesOprUpdateFactory;
use App\Http\Interface\ModelCreateFactoryInterface;
use App\Http\Interface\ModelUpdateFactoryInterface;
use App\Http\Repository\trait\CastTrait;
use App\Models\CryptoEntriesOpr;

class CryptoEntriesOprRepository extends AbstractBaseRepository
{
    use CastTrait;

    public function getModel(): string
    {
        return CryptoEntriesOpr::class;
    }

    public function __construct(
        private readonly CryptoEntriesCreateOprFactory $createFactory,
        private readonly CryptoEntriesOprUpdateFactory $updateFactory,
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
