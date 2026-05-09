<?php

namespace Src\Permission\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * Model para representar un rol del sistema.
 * Extiende el modelo del paquete spatie/laravel-permission.
 */
class Role extends Model
{
    use HasFactory;

    /**
     * El modelo base del paquete spatie/laravel-permission.
     */
    protected $fillable = [
        'name',
        'guard_name',
    ];

    /**
     * Relación con los permisos.
     */
    public function permissions()
    {
        return $this->belongsToMany(SpatieRole::class, 'role_has_permissions', 'role_id', 'permission_id');
    }

    /**
     * Relación con los usuarios.
     */
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'role_has_permissions', 'role_id', 'user_id');
    }
}
