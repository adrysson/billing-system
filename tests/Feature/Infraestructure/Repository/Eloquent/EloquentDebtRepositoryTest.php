<?php

namespace Tests\Feature\Infraestructure\Repository\Eloquent;

use App\Domain\Collection\DebtCollection;
use App\Domain\Enum\DebtsStorageStatus;
use App\Infraestructure\Repository\Eloquent\EloquentDebtRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\Stubs\Domain\Entity\DebtStub;

class EloquentDebtRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    public function test_should_must_persist_data_in_database_and_return_success_status_when_valid_data_is_sent()
    {
        $repository = new EloquentDebtRepository;

        $debts = new DebtCollection;

        $items = [
            DebtStub::random(),
            DebtStub::random(),
            DebtStub::random(),
        ];

        foreach ($items as $item) {
            $debts->push($item);
        }

        $status = $repository->saveAll($debts);

        $this->assertEquals(DebtsStorageStatus::SUCCESS, $status);

        foreach ($debts->getIterator() as $debt) {
            $debtsSaved[] = $repository->find($debt->id);
        }

        $this->assertEquals(json_encode($items), json_encode($debtsSaved));
    }
}