<?php

namespace Tests\Unit\Domain\ValueObject;

use App\Domain\ValueObject\GovernmentId;
use PHPUnit\Framework\TestCase;

class GovernmentIdTest extends TestCase
{
    public function test_should_return_value_when_json_serialize(): void
    {
        $governmentIdValue = '72891053702';

        $governmentId = GovernmentId::create($governmentIdValue);

        $this->assertEquals(json_encode($governmentId->value), json_encode($governmentId));
    }

    public function test_should_throw_invalid_argument_exception_when_cpf_is_invalid()
    {
        $this->expectException(\InvalidArgumentException::class);

        $governmentIdValue = '11111111111';

        GovernmentId::create($governmentIdValue);
    }
}