<?php

namespace Tests\Stubs\Domain\ValueObject\Payment;

use App\Domain\ValueObject\Payment\PaymentAmount;
use Tests\Stubs\FakerGenerator;

class PaymentAmountStub
{
    public static function random(): PaymentAmount
    {
        $faker = FakerGenerator::make();
        return PaymentAmount::create($faker->randomFloat(2, 0, 99999));
    }
}