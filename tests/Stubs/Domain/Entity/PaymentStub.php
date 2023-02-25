<?php

namespace Tests\Stubs\Domain\Entity;

use App\Domain\Entity\Payment;
use Tests\Stubs\Domain\ValueObject\Payment\PayDayStub;
use Tests\Stubs\Domain\ValueObject\Payment\PayerNameStub;
use Tests\Stubs\Domain\ValueObject\Payment\PaymentAmountStub;

class PaymentStub
{
    public static function random(): Payment
    {
        return new Payment(
            payDay: PayDayStub::random(),
            amount: PaymentAmountStub::random(),
            payerName: PayerNameStub::random(),
            debt: DebtStub::random(),
        );
    }
}