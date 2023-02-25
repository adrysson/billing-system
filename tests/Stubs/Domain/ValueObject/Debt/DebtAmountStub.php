<?php

namespace Tests\Stubs\Domain\ValueObject\Debt;

use App\Domain\ValueObject\Debt\DebtAmount;
use Tests\Stubs\FakerGenerator;

class DebtAmountStub
{
    public static function random(): DebtAmount
    {
        $faker = FakerGenerator::make();
        return DebtAmount::create($faker->randomFloat(2, 0, 99999));
    }
}