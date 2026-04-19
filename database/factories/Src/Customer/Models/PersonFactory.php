<?php

namespace Database\Factories\Src\Customer\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Customer\Models\Person;

class PersonFactory extends Factory
{
    protected $model = Person::class;

    public function definition(): array
    {
        return [
            'document_type' => 'DNI',
            'document_number' => $this->faker->unique()->numerify('########'),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
