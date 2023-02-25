<?php

namespace Tests\Unit\Domain\ValueObject\Payment;

use App\Domain\ValueObject\Payment\PaymentTime;
use PHPUnit\Framework\TestCase;

class PaymentTimeTest extends TestCase
{
    public function test_should_return_value_when_json_serialize(): void
    {
        $paymentTimeValue = '2022-06-09 10:00:00';

        $paymentTime = PaymentTime::create($paymentTimeValue);

        $this->assertEquals(json_encode($paymentTime->value), json_encode($paymentTime));
    }
}