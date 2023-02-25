<?php

namespace Tests\Unit\Domain\ValueObject\Payment;

use App\Domain\ValueObject\Payment\PayDay;
use PHPUnit\Framework\TestCase;

class PayDayTest extends TestCase
{
    public function test_should_return_value_when_json_serialize(): void
    {
        $payDayValue = '2022-06-09 10:00:00';

        $payDay = PayDay::create($payDayValue);

        $this->assertEquals(json_encode($payDay->value), json_encode($payDay));
    }
}