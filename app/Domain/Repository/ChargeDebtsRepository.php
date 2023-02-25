<?php

namespace App\Domain\Repository;

use App\Domain\Collection\DebtCollection;
use App\Domain\Enum\DebtsChargeStatus;

interface ChargeDebtsRepository
{
    public function chargeAll(DebtCollection $debt): DebtsChargeStatus;
}