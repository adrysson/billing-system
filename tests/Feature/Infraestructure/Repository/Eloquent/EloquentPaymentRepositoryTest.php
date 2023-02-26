<?php

namespace Tests\Feature\Infraestructure\Repository\Eloquent;

use App\Domain\Enum\PaymentStorageStatus;
use App\Infraestructure\Models\Debt;
use App\Infraestructure\Models\Payment;
use App\Infraestructure\Repository\Eloquent\EloquentPaymentRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Stubs\Domain\Entity\PaymentStub;
use Tests\TestCase;

class EloquentPaymentRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    public function test_should_must_persist_data_in_database_and_return_success_status_when_valid_data_is_sent()
    {
        $repository = new EloquentPaymentRepository;

        $payment = PaymentStub::random();

        Debt::insert([
            Debt::ID => $payment->debt->id->value,
            Debt::NAME => $payment->debt->debtor->name->value,
            Debt::GOVERNMENT_ID => $payment->debt->debtor->governmentId->value,
            Debt::EMAIL => $payment->debt->debtor->email->value,
            Debt::AMOUNT => $payment->debt->amount->value,
            Debt::DUE_DATE => $payment->debt->dueDate->value,
        ]);

        $status = $repository->save($payment);

        $this->assertEquals(PaymentStorageStatus::SUCCESS, $status);

        $this->assertDatabaseHas(Payment::class, [
            Payment::DEBT_ID => $payment->debt->id->value,
            Payment::PAID_AT => $payment->paymentTime->value,
            Payment::AMOUNT => $payment->amount->value,
            Payment::PAID_BY => $payment->payerName->value,
        ]);
    }
}