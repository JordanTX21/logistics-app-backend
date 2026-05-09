<?php

namespace Database\Factories\Src\Permission\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Permission\Models\Role;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'guard_name' => 'api',
        ];
    }
}
