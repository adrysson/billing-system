<?php

namespace Tests\Unit\Domain\ValueObject;

use App\Domain\ValueObject\Currency;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    public function test_should_return_value_when_json_serialize(): void
    {
        $paymentAmountValue = 100000.00;

        $paymentAmount = Currency::create($paymentAmountValue);

        $this->assertEquals(json_encode($paymentAmount->value), json_encode($paymentAmount));
    }
}