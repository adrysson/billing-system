<?php

namespace Tests\Stubs\Domain\ValueObject\Debtor;

use App\Domain\ValueObject\Debtor\DebtorName;

class DebtorNameStub
{
    public static function random(): DebtorName
    {
        $faker = \Faker\Factory::create('pt_BR');
        return DebtorName::create($faker->name());
    }
}