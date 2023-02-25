<?php

namespace Tests\Unit\Domain\ValueObject\Debt;

use App\Domain\ValueObject\Debt\DebtDueDate;
use PHPUnit\Framework\TestCase;

class DebtDueDateTest extends TestCase
{
    public function test_should_return_value_when_json_serialize(): void
    {
        $debtDueDateValue = '2022-10-12';

        $debtDueDate = DebtDueDate::create($debtDueDateValue);

        $this->assertEquals(json_encode($debtDueDate->value), json_encode($debtDueDate));
    }
}