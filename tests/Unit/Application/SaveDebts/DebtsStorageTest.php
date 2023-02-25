<?php

namespace Tests\Unit\Application\SaveDebts;

use App\Application\SaveDebts\DebtsStorage;
use App\Application\SaveDebts\DebtsStorageResponse;
use App\Domain\Collection\DebtCollection;
use App\Domain\Enum\DebtStorageStatus;
use App\Domain\Repository\SaveDebtRepository;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entity\DebtStub;

class DebtsStorageTest extends TestCase
{
    /** @dataProvider provideDebtStorageStatus */
    public function test_should_return_debts_storage_response_when_invoke(DebtStorageStatus $status)
    {
        $debtRepository = \Mockery::mock(SaveDebtRepository::class);
        $debtRepository->shouldReceive('saveAll')
            ->andReturn($status);

        $debts = new DebtCollection;

        $debts->push(DebtStub::random());
        $debts->push(DebtStub::random());
        $debts->push(DebtStub::random());

        $debtsStorage = new DebtsStorage($debtRepository);

        $response = $debtsStorage($debts);

        $this->assertInstanceOf(DebtsStorageResponse::class, $response);
    }

    public static function provideDebtStorageStatus(): \Iterator
    {
        $debtStorageStatusCases = DebtStorageStatus::cases();

        foreach ($debtStorageStatusCases as $debtStorageStatus) {
            yield 'status-' . $debtStorageStatus->name => [
                'status' => $debtStorageStatus,
            ];
        }
    }
}