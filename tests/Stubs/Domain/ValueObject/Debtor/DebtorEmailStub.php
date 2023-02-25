<?php

namespace Tests\Stubs\Domain\ValueObject\Debtor;

use App\Domain\ValueObject\Debtor\DebtorEmail;
use Tests\Stubs\FakerGenerator;

class DebtorEmailStub
{
    public static function random(): DebtorEmail
    {
        $faker = FakerGenerator::make();
        return DebtorEmail::create($faker->email());
    }
}