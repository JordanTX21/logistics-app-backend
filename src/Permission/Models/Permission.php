<?php

namespace Src\Permission\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * Model para representar un permiso del sistema.
 * Extiende el modelo del paquete spatie/laravel-permission.
 */
class Permission extends Model
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
     * Relación con los roles.
     */
    public function roles()
    {
        return $this->belongsToMany(SpatiePermission::class, 'role_has_permissions', 'permission_id', 'role_id');
    }

    /**
     * Relación con los usuarios.
     */
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'model_has_permissions', 'permission_id', 'model_id');
    }
}
