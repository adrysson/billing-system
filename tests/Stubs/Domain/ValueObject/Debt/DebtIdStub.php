<?php

namespace Tests\Stubs\Domain\ValueObject\Debt;

use App\Domain\ValueObject\Debt\DebtId;
use Tests\Stubs\FakerGenerator;

class DebtIdStub
{
    public static function random(): DebtId
    {
        $faker = FakerGenerator::make();
        return DebtId::create($faker->randomNumber());
    }
}