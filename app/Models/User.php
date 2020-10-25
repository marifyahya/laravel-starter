<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'employees';
    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'gender',
        'birth_place',
        'birth_date',
        'photo',
        'address',
        'nip',
        'nik',
        'phone',
        'decision_number',
        'position_id',
        'employee_status',
        'last_diploma',
        'last_diploma_year',
        'description',
        'state',
        'role_id',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function getBirthDateAttribute($value) {
        return dateId($value);
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = dateDb($value);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function menu() {
        $dataMenu = MenuRole::leftJoin('menus', 'menus.menu_id', 'menu_role.menu_id')
            ->select(
                'menus.*'
            )
            ->orderBy('menus.ordinal')
            ->get();

        $listMenu = collect([]);
        foreach ($dataMenu->where('groupmenu', null) as $key => $menuUtama) {
            $listMenu[$key] = $menuUtama;
            $listMenu[$key]['submenu'] = $dataMenu->where('groupmenu', $menuUtama->menu_id);
        }
        return $listMenu;
	}
}
