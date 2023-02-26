<?php

namespace Tests\Feature\Infraestructure\Repository\Eloquent;

use App\Domain\Collection\DebtCollection;
use App\Domain\Enum\DebtsStorageStatus;
use App\Infraestructure\Models\Payment;
use App\Infraestructure\Repository\Eloquent\EloquentDebtRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Stubs\Domain\Entity\PaymentStub;
use Tests\TestCase;
use Tests\Stubs\Domain\Entity\DebtStub;

class EloquentDebtRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    public function test_should_must_persist_data_in_database_and_return_success_status_when_valid_data_is_sent()
    {
        $repository = new EloquentDebtRepository;

        $debts = new DebtCollection;

        $debtItems = [
            DebtStub::random(),
            DebtStub::random(),
            DebtStub::random(),
        ];

        foreach ($debtItems as $debtItem) {
            $debts->push($debtItem);
        }

        $status = $repository->saveAll($debts);

        $this->assertEquals(DebtsStorageStatus::SUCCESS, $status);

        foreach ($debts->getIterator() as $debt) {
            $debtsSaved[] = $repository->find($debt->id);
        }

        $this->assertEquals(json_encode($debtItems), json_encode($debtsSaved));
    }

    public function test_should_get_pendings_method_return_only_debts_no_full_amount_paid()
    {
        $repository = new EloquentDebtRepository;

        $debts = new DebtCollection;

        $partialPayment = PaymentStub::partial();

        $pendingDebtItems = [
            DebtStub::random(),
            DebtStub::random(),
            DebtStub::random(),
            $partialPayment->debt,
        ];

        foreach ($pendingDebtItems as $pendingDebtItem) {
            $debts->push($pendingDebtItem);
        }

        $completePayment = PaymentStub::complete();

        $debtWithCompletePayment = $completePayment->debt;

        $debts->push($debtWithCompletePayment);

        $status = $repository->saveAll($debts);

        $this->assertEquals(DebtsStorageStatus::SUCCESS, $status);

        Payment::insert([
            [
                Payment::DEBT_ID => $partialPayment->debt->id->value,
                Payment::PAID_AT => $partialPayment->paymentTime->value,
                Payment::AMOUNT => $partialPayment->amount->value,
                Payment::PAID_BY => $partialPayment->payerName->value,
            ],
            [
                Payment::DEBT_ID => $completePayment->debt->id->value,
                Payment::PAID_AT => $completePayment->paymentTime->value,
                Payment::AMOUNT => $completePayment->amount->value,
                Payment::PAID_BY => $completePayment->payerName->value,
            ],
        ]);

        $pendingDebts = $repository->getPendings();

        $this->assertCount(count($pendingDebtItems), $pendingDebts);

        foreach ($pendingDebts->getIterator() as $debt) {
            $pendingDebtItems[] = $debt;
            $this->assertTrue(in_array($debt, $pendingDebtItems));
        }

        $this->assertFalse(in_array($debtWithCompletePayment, $pendingDebtItems));
    }
}