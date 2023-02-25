<?php

namespace Tests\Stubs\Domain\ValueObject\Payment;

use App\Domain\ValueObject\Payment\PayDay;
use Tests\Stubs\FakerGenerator;

class PayDayStub
{
    public static function random(): PayDay
    {
        $faker = FakerGenerator::make();
        return PayDay::create($faker->dateTime()->format('Y-m-d H:i:s'));
    }
}