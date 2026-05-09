<?php

namespace Database\Factories\Src\Permission\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Permission\Models\Permission;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'guard_name' => 'api',
        ];
    }
}
