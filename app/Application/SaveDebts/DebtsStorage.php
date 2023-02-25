<?php

namespace App\Application\SaveDebts;

use App\Domain\Collection\DebtCollection;
use App\Domain\Repository\SaveDebtRepository;

class DebtsStorage
{
    public function __construct(private SaveDebtRepository $debtRepository)
    {
    }

    public function __invoke(DebtCollection $debts): DebtsStorageResponse
    {
        $debtsStorageStatus = $this->debtRepository->saveAll($debts);

        return new DebtsStorageResponse($debtsStorageStatus);
    }
}