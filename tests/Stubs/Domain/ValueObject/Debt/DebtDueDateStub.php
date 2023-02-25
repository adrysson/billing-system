<?php

namespace Tests\Stubs\Domain\ValueObject\Debt;

use App\Domain\ValueObject\Debt\DebtDueDate;
use Tests\Stubs\FakerGenerator;

class DebtDueDateStub
{
    public static function random(): DebtDueDate
    {
        $faker = FakerGenerator::make();
        return DebtDueDate::create($faker->date());
    }
}