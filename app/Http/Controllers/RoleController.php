<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\MenuRole;
use App\Models\PermissionRole;
use DataTables;
use DB;

class RoleController extends Controller
{
    public function index() {
        return view('role.index');
    }

    public function table() {
        $data = Role::select();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('state', function($data){
                return $data->state == '1' ? 'Aktif' : 'Non Aktif';
            })
            ->addColumn('action', function($data){
                return '<a href="'. route('role') .'/'. $data->role_id .'" class="btn btn-sm btn-default mr-2"><i class="fa fa-edit"></i></a>'
                    . '<button class="btn btn-sm btn-danger btn-delete" value="'. $data->role_id .'"><i class="fa fa-trash"></i></button>';
            })
            ->make(true);
    }

    public function create() {
        $menu = Menu::getAllMenuPermission();
        return view('role.create', compact('menu'));
    }
    public function store(RoleRequest $request) {
        try {
            DB::beginTransaction();
            $role = Role::create([
                'role_name' => $request->role_name,
                'state' => $request->state
            ]);

            $allMenu = Menu::all();
            foreach ($request->menu as $menu) {
                $thisMenu = $allMenu->firstWhere('menu_id', $menu);
                if (!is_null($thisMenu)) {
                    MenuRole::firstOrCreate([
                        'role_id' => $id,
                        'menu_id' => $thisMenu->groupmenu
                    ]);
                }

                MenuRole::create([
                    'role_id' => $role->role_id,
                    'menu_id' => $menu
                ]);
            }
            foreach ($request->permission as $permission) {
                PermissionRole::create([
                    'role_id' => $role->role_id,
                    'permission_id' => $permission
                ]);
            }
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return $e;
        }

        return redirect('role')->with('success', 'Role ' . $request->role_name . ' berhasil ditambahkan.');
    }

    public function edit($id) {
        $role = Role::find($id)->with('menu')->with('permission')->first();
        if ($role == null) abort(404);
        $menu = Menu::getAllMenuPermission();
        return view('role.edit', compact('menu', 'role'));
    }
    
    public function update(RoleRequest $request, $id) {
        try {
            DB::beginTransaction();
            Role::find($id)->update([
                'role_name' => $request->role_name,
                'state' => $request->state
            ]);

            MenuRole::where('role_id', $id)->delete();
            if ($request->menu) {
                $allMenu = Menu::all();
                foreach ($request->menu as $menu) {
                    $thisMenu = $allMenu->firstWhere('menu_id', $menu);
                    if (!is_null($thisMenu)) {
                        MenuRole::firstOrCreate([
                            'role_id' => $id,
                            'menu_id' => $thisMenu->groupmenu
                        ]);
                    }

                    MenuRole::create([
                        'role_id' => $id,
                        'menu_id' => $menu
                    ]);
                }
            }
            PermissionRole::where('role_id', $id)->delete();
            if ($request->permission) {
                foreach ($request->permission as $permission) {
                    PermissionRole::create([
                        'role_id' => $id,
                        'permission_id' => $permission
                    ]);
                }
            }
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return $e;
        }

        return redirect('role')->with('success', 'Role ' . $request->role_name . ' berhasil diperbaharui.');
    }
    public function destroy($id) {
        $role = Role::find($id);
        try {
            DB::beginTransaction();
            $role->delete();
            MenuRole::where('role_id', $id)->delete();
            PermissionRole::where('role_id', $id)->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return $e;
        }
        return response()->json('Role ' .$role->role_name. 'berhasil dihapus', 200);
    }
}
