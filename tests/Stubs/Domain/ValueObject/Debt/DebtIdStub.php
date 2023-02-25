<?php

namespace Tests\Stubs\Domain\ValueObject\Debt;

use App\Domain\ValueObject\Debt\DebtId;

class DebtIdStub
{
    public static function random(): DebtId
    {
        $faker = \Faker\Factory::create('pt_BR');
        return DebtId::create($faker->randomNumber());
    }
}