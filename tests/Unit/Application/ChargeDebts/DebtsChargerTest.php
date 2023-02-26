<?php

namespace Tests\Unit\Application\ChargeDebts;

use App\Application\ChargeDebts\DebtsCharger;
use App\Application\ChargeDebts\DebtsChargerResponse;
use App\Domain\Collection\DebtCollection;
use App\Domain\Enum\DebtsChargeStatus;
use App\Domain\Repository\ChargeDebtsRepository;
use App\Domain\Repository\GetPendingDebtsRepository;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entity\DebtStub;

class DebtsChargerTest extends TestCase
{
    /** @dataProvider provideDebtsChargeStatus */
    public function test_should_return_debts_charge_response_when_invoke(DebtsChargeStatus $status)
    {
        $debts = new DebtCollection;

        $debts->push(DebtStub::random());
        $debts->push(DebtStub::random());
        $debts->push(DebtStub::random());

        $getPendingDebtsRepository = \Mockery::mock(GetPendingDebtsRepository::class);
        $getPendingDebtsRepository->shouldReceive('getPendings')
            ->andReturn($debts);

        $chargeDebtRepository = \Mockery::mock(ChargeDebtsRepository::class);
        $chargeDebtRepository->shouldReceive('chargeAll')
            ->andReturn($status);

        $debtsCharger = new DebtsCharger(
            getPendingDebtsRepository: $getPendingDebtsRepository,
            chargeDebtsRepository: $chargeDebtRepository,
        );

        $response = $debtsCharger($debts);

        $this->assertInstanceOf(DebtsChargerResponse::class, $response);
    }

    public static function provideDebtsChargeStatus(): \Iterator
    {
        $debtsChargerStatusCases = DebtsChargeStatus::cases();

        foreach ($debtsChargerStatusCases as $debtsChargerStatus) {
            yield 'status-' . $debtsChargerStatus->name => [
                'status' => $debtsChargerStatus,
            ];
        }
    }
}