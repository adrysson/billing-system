<?php

namespace Tests\Unit\Domain\ValueObject\Debt;

use App\Domain\ValueObject\Debt\DebtAmount;
use PHPUnit\Framework\TestCase;

class DebtAmountTest extends TestCase
{
    public function test_should_return_value_when_json_serialize(): void
    {
        $debtAmountValue = 1000000.00;

        $debtAmount = DebtAmount::create($debtAmountValue);

        $this->assertEquals(json_encode($debtAmount->value), json_encode($debtAmount));
    }
}