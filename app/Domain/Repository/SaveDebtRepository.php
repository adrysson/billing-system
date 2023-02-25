<?php

namespace App\Domain\Repository;

use App\Domain\Collection\DebtCollection;

interface SaveDebtRepository
{
    public function saveAll(DebtCollection $debts): bool;
}