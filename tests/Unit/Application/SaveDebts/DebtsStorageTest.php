<?php

namespace Tests\Unit\Application\SaveDebts;

use App\Application\SaveDebts\DebtsStorage;
use App\Application\SaveDebts\DebtsStorageResponse;
use App\Domain\Collection\DebtCollection;
use App\Domain\Repository\SaveDebtRepository;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entity\DebtStub;

class DebtsStorageTest extends TestCase
{
    public function test_should_return_debts_storage_response_when_invoke()
    {
        $debtRepository = \Mockery::mock(SaveDebtRepository::class);
        $debtRepository->shouldReceive('saveAll')
            ->andReturn(true);

        $debts = new DebtCollection;

        $debts->push(DebtStub::random());
        $debts->push(DebtStub::random());
        $debts->push(DebtStub::random());

        $debtsStorage = new DebtsStorage($debtRepository);

        $response = $debtsStorage($debts);

        $this->assertInstanceOf(DebtsStorageResponse::class, $response);
    }
}