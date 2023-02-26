<?php

namespace Tests\Unit\Application\NotifyDebts;

use App\Application\NotifyDebts\DebtsNotifier;
use App\Application\NotifyDebts\DebtsNotifierResponse;
use App\Domain\Collection\DebtCollection;
use App\Domain\Enum\DebtsNotificationStatus;
use App\Domain\Repository\NotifyDebtsRepository;
use App\Domain\Repository\GetPendingDebtsRepository;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entity\DebtStub;

class DebtsNotifierTest extends TestCase
{
    /** @dataProvider provideDebtsNotificationStatus */
    public function test_should_return_debts_notify_response_when_invoke(DebtsNotificationStatus $status)
    {
        $debts = new DebtCollection;

        $debts->push(DebtStub::random());
        $debts->push(DebtStub::random());
        $debts->push(DebtStub::random());

        $getPendingDebtsRepository = \Mockery::mock(GetPendingDebtsRepository::class);
        $getPendingDebtsRepository->shouldReceive('getPendings')
            ->andReturn($debts);

        $notifyDebtRepository = \Mockery::mock(NotifyDebtsRepository::class);
        $notifyDebtRepository->shouldReceive('notify')
            ->andReturn($status);

        $debtsCharger = new DebtsNotifier(
            getPendingDebtsRepository: $getPendingDebtsRepository,
            notifyDebtsRepository: $notifyDebtRepository,
        );

        $response = $debtsCharger($debts);

        $this->assertInstanceOf(DebtsNotifierResponse::class, $response);
    }

    public static function provideDebtsNotificationStatus(): \Iterator
    {
        $debtsChargerStatusCases = DebtsNotificationStatus::cases();

        foreach ($debtsChargerStatusCases as $debtsChargerStatus) {
            yield 'status-' . $debtsChargerStatus->name => [
                'status' => $debtsChargerStatus,
            ];
        }
    }
}