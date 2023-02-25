<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Debt;
use App\Domain\ValueObject\Debt\DebtId;

interface FindDebtRepository
{
    public function find(DebtId $debtId): Debt;
}