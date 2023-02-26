<?php

namespace Tests\Stubs\Domain\Entity;

use App\Domain\Entity\Payment;
use App\Domain\ValueObject\Currency;
use Tests\Stubs\Domain\ValueObject\CurrencyStub;
use Tests\Stubs\Domain\ValueObject\Payment\PaymentTimeStub;
use Tests\Stubs\Domain\ValueObject\Payment\PayerNameStub;

class PaymentStub
{
    public static function random(): Payment
    {
        return new Payment(
            paymentTime: PaymentTimeStub::random(),
            amount: CurrencyStub::random(),
            payerName: PayerNameStub::random(),
            debt: DebtStub::random(),
        );
    }

    public static function partial(): Payment
    {
        $debt = DebtStub::random();

        $amount = CurrencyStub::randomLessThan($debt->amount);

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

        $amount = Currency::create($debt->amount->value);

        return new Payment(
            paymentTime: PaymentTimeStub::random(),
            amount: $amount,
            payerName: PayerNameStub::random(),
            debt: $debt,
        );
    }
}