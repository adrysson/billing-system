<?php

namespace Tests\Feature\Infraestructure\Repository\Log;

use App\Domain\Collection\DebtCollection;
use App\Domain\Enum\DebtsNotificationStatus;
use App\Infraestructure\Repository\Log\LogDebtRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Stubs\Domain\Entity\DebtStub;
use Tests\TestCase;

class LogDebtRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    public function test_should_notify_method_return_success_debts_notification_status()
    {
        $repository = new LogDebtRepository;

        $debts = new DebtCollection;

        $debtItems = [
            DebtStub::random(),
            DebtStub::random(),
            DebtStub::random(),
        ];

        foreach ($debtItems as $debtItem) {
            $debts->push($debtItem);
        }

        $response = $repository->notify($debts);

        $this->assertEquals(DebtsNotificationStatus::SUCCESS, $response);
    }
}