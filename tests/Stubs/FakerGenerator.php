<?php

namespace Tests\Stubs;

use Faker\Factory;
use Faker\Generator;

class FakerGenerator
{
    public static function make(): Generator
    {
        return Factory::create('pt_BR');
    }
}