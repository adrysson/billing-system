<?php

namespace Tests\Stubs\Domain\Entity;

use App\Domain\Entity\Payment;
use App\Domain\ValueObject\Payment\PaymentAmount;
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

    public static function partial(): Payment
    {
        $debt = DebtStub::random();

        $amount = PaymentAmountStub::randomLessThan($debt->amount->value);

        return new Payment(
            paymentTime: PaymentTimeStub::random(),
            amount: $amount,
            payerName: PayerNameStub::random(),
            debt: $debt,
        );
    }

    public static function complete(): Payment
    {
        $debt = DebtStub::random();

        $amount = PaymentAmount::create($debt->amount->value);

        return new Payment(
            paymentTime: PaymentTimeStub::random(),
            amount: $amount,
            payerName: PayerNameStub::random(),
            debt: $debt,
        );
    }
}