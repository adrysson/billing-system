<?php

namespace Tests\Unit\Domain\ValueObject\Payment;

use App\Domain\ValueObject\Payment\PayerName;
use PHPUnit\Framework\TestCase;

class PayerNameTest extends TestCase
{
    public function test_should_return_value_when_json_serialize(): void
    {
        $payerNameValue = 'John Doe';

        $payerName = PayerName::create($payerNameValue);

        $this->assertEquals(json_encode($payerName->value), json_encode($payerName));
    }
}