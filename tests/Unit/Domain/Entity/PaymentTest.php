<?php

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\Payment;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entity\DebtStub;
use Tests\Stubs\Domain\ValueObject\Payment\PaymentTimeStub;
use Tests\Stubs\Domain\ValueObject\Payment\PayerNameStub;
use Tests\Stubs\Domain\ValueObject\Payment\PaymentAmountStub;

class PaymentTest extends TestCase
{
    public function test_should_return_payment_data_when_json_serialize(): void
    {
        $paymentTime = PaymentTimeStub::random();

        $paymentAmount = PaymentAmountStub::random();

        $payerName = PayerNameStub::random();

        $debt = DebtStub::random();

        $payment = new Payment(
            paymentTime: $paymentTime,
            amount: $paymentAmount,
            payerName: $payerName,
            debt: $debt,
        );

        $this->assertEquals(json_encode([
            Payment::PAY_DAY => $paymentTime->value,
            Payment::AMOUNT => $paymentAmount->value,
            Payment::PAYER_NAME => $payerName->value,
            Payment::DEBT => $debt->jsonSerialize(),
        ]), json_encode($payment));
    }
}