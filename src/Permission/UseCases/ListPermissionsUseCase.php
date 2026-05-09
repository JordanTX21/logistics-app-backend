<?php

namespace Src\Permission\UseCases;

use App\Models\User;
use Spatie\Permission\Models\Permission;

/**
 * UseCase para listar permisos.
 */
class ListPermissionsUseCase
{
    public function __construct(
        private readonly User $currentUser
    ) {}

    /**
     * List all permissions with optional filtering
     *
     * @param int|null $id Filter by permission ID
     * @return Permission[]
     */
    public function execute(?int $id = null): array
    {
        $query = Permission::query();

        if ($id !== null) {
            $query->where('id', $id);
        }

        return $query->get();
    }

    /**
     * Find a permission by ID or throw exception
     *
     * @param int $id
     * @return Permission
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail(int $id): Permission
    {
        $permission = $this->execute($id)->first();

        if (!$permission) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException("Permission not found with ID {$id}");
        }

        return $permission;
    }
}
