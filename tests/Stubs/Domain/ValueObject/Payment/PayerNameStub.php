<?php

namespace Tests\Stubs\Domain\ValueObject\Payment;

use App\Domain\ValueObject\Payment\PayerName;
use Tests\Stubs\FakerGenerator;

class PayerNameStub
{
    public static function random(): PayerName
    {
        $faker = FakerGenerator::make();
        return PayerName::create($faker->name());
    }
}