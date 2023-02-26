<?php

namespace Tests\Unit\Domain\ValueObject\Debtor;

use App\Domain\ValueObject\Debtor\DebtorEmail;
use PHPUnit\Framework\TestCase;

class DebtorEmailTest extends TestCase
{
    public function test_should_return_value_when_json_serialize(): void
    {
        $debtorEmailValue = 'johndoe@kanastra.com.br';

        $debtorEmail = DebtorEmail::create($debtorEmailValue);

        $this->assertEquals(json_encode($debtorEmail->value), json_encode($debtorEmail));
    }

    public function test_should_throw_invalid_argument_exception_when_email_is_invalid()
    {
        $this->expectException(\InvalidArgumentException::class);

        $debtorEmailValue = 'johndoe';

        DebtorEmail::create($debtorEmailValue);
    }
}