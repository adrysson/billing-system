<?php

namespace App\Application\NotifyDebts;

use App\Application\NotifyDebts\DebtsNotifierResponse;
use App\Domain\Repository\NotifyDebtsRepository;
use App\Domain\Repository\GetPendingDebtsRepository;

class DebtsNotifier
{
    public function __construct(
        private GetPendingDebtsRepository $getPendingDebtsRepository,
        private NotifyDebtsRepository $notifyDebtsRepository,
    )
    {
    }

    public function __invoke(): DebtsNotifierResponse
    {
        $debts = $this->getPendingDebtsRepository->getPendings();

        $debtsNotificationStatus = $this->notifyDebtsRepository->notify($debts);

        return new DebtsNotifierResponse($debtsNotificationStatus);
    }
}