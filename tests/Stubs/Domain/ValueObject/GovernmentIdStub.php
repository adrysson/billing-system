<?php

namespace Tests\Stubs\Domain\ValueObject;

use App\Domain\ValueObject\GovernmentId;
use Tests\Stubs\FakerGenerator;

class GovernmentIdStub
{
    public static function random(): GovernmentId
    {
        $faker = FakerGenerator::make();
        return GovernmentId::create($faker->cpf());
    }
}