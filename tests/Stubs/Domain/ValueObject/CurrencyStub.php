<?php

namespace Tests\Stubs\Domain\ValueObject;

use App\Domain\ValueObject\Currency;
use Tests\Stubs\FakerGenerator;

class CurrencyStub
{
    public static function random(): Currency
    {
        $faker = FakerGenerator::make();
        return Currency::create($faker->randomFloat(2, 0, 99999));
    }

    public static function randomLessThan(Currency $max): Currency
    {
        $faker = FakerGenerator::make();
        return Currency::create($faker->randomFloat(2, 0, $max->value - 0.01));
    }
}