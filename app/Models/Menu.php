<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $primaryKey = 'menu_id';
    protected $fillable = [
        'menu_name',
        'link',
        'icon',
        'groupmenu',
        'ordinal',
        'state'
    ];

    public $timestamps = false;

    public static function getGroupmenu() {
        $menu = Menu::where('groupmenu', null)->orderBy('menu_name')->get();
        $menu = collect($menu)->prepend([
            'menu_id' => null,
            'menu_name' => 'Menu Utama'
        ]);

        return $menu;
    }

    public function group()
    {
        return $this->belongsTo(Menu::class, 'groupmenu', 'menu_id');
    }

    public function permission()
    {
        return $this->hasMany(Permission::class, 'menu_id', 'menu_id');
    }

    public static function getAllMenuPermission() {
        return Menu::with(['permission' => function($q){
                $q->orderBy('permission_name');
            }])
            ->orderBy('ordinal')
            ->get();
    }
}
