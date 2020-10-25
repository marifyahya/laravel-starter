<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    protected $fillable = [
        'role_name',
        'state'
    ];

    public function menu()
    {
        return $this->hasMany(MenuRole::class, 'role_id', 'role_id');
    }

    public function permission()
    {
        return $this->hasMany(PermissionRole::class, 'role_id', 'role_id');
    }
}
