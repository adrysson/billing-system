<?php

namespace Tests\Stubs\Domain\ValueObject\Debtor;

use App\Domain\ValueObject\Debtor\DebtorName;
use Tests\Stubs\FakerGenerator;

class DebtorNameStub
{
    public static function random(): DebtorName
    {
        $faker = FakerGenerator::make();
        return DebtorName::create($faker->name());
    }
}