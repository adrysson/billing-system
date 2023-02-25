<?php

namespace App\Domain\Repository;

use App\Domain\Collection\DebtCollection;
use App\Domain\Enum\DebtsStorageStatus;

interface SaveDebtRepository
{
    public function saveAll(DebtCollection $debts): DebtsStorageStatus;
}