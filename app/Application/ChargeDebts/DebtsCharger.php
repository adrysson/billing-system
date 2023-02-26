<?php

namespace App\Application\ChargeDebts;

use App\Application\ChargeDebts\DebtsChargerResponse;
use App\Domain\Repository\ChargeDebtsRepository;
use App\Domain\Repository\GetPendingDebtsRepository;

class DebtsCharger
{
    public function __construct(
        private GetPendingDebtsRepository $getPendingDebtsRepository,
        private ChargeDebtsRepository $chargeDebtsRepository,
    )
    {
    }

    public function __invoke(): DebtsChargerResponse
    {
        $debts = $this->getPendingDebtsRepository->getPendings();

        $debtsChargeStatus = $this->chargeDebtsRepository->chargeAll($debts);

        return new DebtsChargerResponse($debtsChargeStatus);
    }
}