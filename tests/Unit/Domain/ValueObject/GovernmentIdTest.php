<?php

namespace Tests\Unit\Domain\ValueObject;

use App\Domain\ValueObject\GovernmentId;
use PHPUnit\Framework\TestCase;

class GovernmentIdTest extends TestCase
{
    public function test_should_return_value_when_json_serialize(): void
    {
        $governmentIdValue = '12345678912';

        $governmentId = GovernmentId::create($governmentIdValue);

        $this->assertEquals(json_encode($governmentId->value), json_encode($governmentId));
    }
}