<?php

namespace App\Domain\Repository;

use App\Domain\Collection\DebtCollection;

interface GetPendingDebtsRepository
{
    public function get(): DebtCollection;
}