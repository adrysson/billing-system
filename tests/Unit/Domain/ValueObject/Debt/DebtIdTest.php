<?php

namespace Tests\Unit\Domain\ValueObject\Debt;

use App\Domain\ValueObject\Debt\DebtId;
use PHPUnit\Framework\TestCase;

class DebtIdTest extends TestCase
{
    public function test_should_return_value_when_json_serialize(): void
    {
        $debtIdValue = 8291;

        $debtId = DebtId::create($debtIdValue);

        $this->assertEquals(json_encode($debtId->value), json_encode($debtId));
    }
}