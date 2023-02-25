<?php

namespace Tests\Stubs\Domain\ValueObject;

use App\Domain\ValueObject\GovernmentId;

class GovernmentIdStub
{
    public static function random(): GovernmentId
    {
        $faker = \Faker\Factory::create('pt_BR');
        return GovernmentId::create($faker->cpf());
    }
}