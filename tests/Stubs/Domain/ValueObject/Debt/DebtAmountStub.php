<?php

namespace Tests\Stubs\Domain\ValueObject\Debt;

use App\Domain\ValueObject\Debt\DebtAmount;

class DebtAmountStub
{
    public static function random(): DebtAmount
    {
        $faker = \Faker\Factory::create('pt_BR');
        return DebtAmount::create($faker->randomFloat());
    }
}