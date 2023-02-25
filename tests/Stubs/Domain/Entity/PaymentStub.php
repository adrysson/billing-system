<?php

namespace Tests\Stubs\Domain\Entity;

use App\Domain\Entity\Payment;
use Tests\Stubs\Domain\ValueObject\Payment\PaymentTimeStub;
use Tests\Stubs\Domain\ValueObject\Payment\PayerNameStub;
use Tests\Stubs\Domain\ValueObject\Payment\PaymentAmountStub;

class PaymentStub
{
    public static function random(): Payment
    {
        return new Payment(
            paymentTime: PaymentTimeStub::random(),
            amount: PaymentAmountStub::random(),
            payerName: PayerNameStub::random(),
            debt: DebtStub::random(),
        );
    }
}