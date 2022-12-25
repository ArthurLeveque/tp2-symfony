<?php

namespace App\Services;

class FakerService
{
    private $faker;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }

    public function getNewName() 
    {
        return $this->faker->name();
    }
}