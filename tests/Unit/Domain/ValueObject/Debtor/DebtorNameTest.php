<?php

namespace Tests\Unit\Domain\ValueObject\Debtor;

use App\Domain\ValueObject\Debtor\DebtorName;
use PHPUnit\Framework\TestCase;

class DebtorNameTest extends TestCase
{
    public function test_should_return_value_when_json_serialize(): void
    {
        $debtorNameValue = 'John Doe';

        $debtorName = DebtorName::create($debtorNameValue);

        $this->assertEquals(json_encode($debtorName->value), json_encode($debtorName));
    }
}