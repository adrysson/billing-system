<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Debt;

interface ChargeDebtRepository
{
    public function charge(Debt $debt): bool;
}