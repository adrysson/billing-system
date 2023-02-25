<?php

namespace Tests\Stubs\Domain\ValueObject\Debtor;

use App\Domain\ValueObject\Debtor\DebtorEmail;

class DebtorEmailStub
{
    public static function random(): DebtorEmail
    {
        $faker = \Faker\Factory::create('pt_BR');
        return DebtorEmail::create($faker->email());
    }
}