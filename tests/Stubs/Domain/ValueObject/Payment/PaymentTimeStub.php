<?php

namespace Tests\Stubs\Domain\ValueObject\Payment;

use App\Domain\ValueObject\Payment\PaymentTime;
use Tests\Stubs\FakerGenerator;

class PaymentTimeStub
{
    public static function random(): PaymentTime
    {
        $faker = FakerGenerator::make();
        return PaymentTime::create($faker->dateTime()->format('Y-m-d H:i:s'));
    }
}