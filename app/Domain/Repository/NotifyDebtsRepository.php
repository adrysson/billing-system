<?php

namespace App\Domain\Repository;

use App\Domain\Collection\DebtCollection;
use App\Domain\Enum\DebtsNotificationStatus;

interface NotifyDebtsRepository
{
    public function notify(DebtCollection $debt): DebtsNotificationStatus;
}