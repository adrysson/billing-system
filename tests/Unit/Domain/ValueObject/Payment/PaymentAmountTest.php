<?php

namespace Tests\Unit\Domain\ValueObject\Payment;

use App\Domain\ValueObject\Payment\PaymentAmount;
use PHPUnit\Framework\TestCase;

class PaymentAmountTest extends TestCase
{
    public function test_should_return_value_when_json_serialize(): void
    {
        $paymentAmountValue = 100000.00;

        $paymentAmount = PaymentAmount::create($paymentAmountValue);

        $this->assertEquals(json_encode($paymentAmount->value), json_encode($paymentAmount));
    }
}