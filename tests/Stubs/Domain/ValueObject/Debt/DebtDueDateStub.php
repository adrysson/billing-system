<?php

namespace Tests\Stubs\Domain\ValueObject\Debt;

use App\Domain\ValueObject\Debt\DebtDueDate;

class DebtDueDateStub
{
    public static function random(): DebtDueDate
    {
        $faker = \Faker\Factory::create('pt_BR');
        return DebtDueDate::create($faker->date());
    }
}