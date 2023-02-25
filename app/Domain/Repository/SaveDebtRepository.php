<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Debt;

interface SaveDebtRepository
{
    public function save(Debt $debt): bool;
}