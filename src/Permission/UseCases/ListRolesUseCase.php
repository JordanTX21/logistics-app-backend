<?php

namespace Src\Permission\UseCases;

use App\Models\User;
use Spatie\Permission\Models\Role;

/**
 * UseCase para listar roles.
 */
class ListRolesUseCase
{
    public function __construct(
        private readonly User $currentUser
    ) {}

    /**
     * List all roles with optional filtering
     *
     * @param int|null $id Filter by role ID
     * @return Role[]
     */
    public function execute(?int $id = null): array
    {
        $query = Role::query();

        if ($id !== null) {
            $query->where('id', $id);
        }

        return $query->get();
    }

    /**
     * Find a role by ID or throw exception
     *
     * @param int $id
     * @return Role
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail(int $id): Role
    {
        $role = $this->execute($id)->first();

        if (!$role) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException("Role not found with ID {$id}");
        }

        return $role;
    }
}
