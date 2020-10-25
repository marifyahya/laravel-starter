<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use App\Models\Menu;
use App\Models\Permission;
use DataTables;

class PermissionController extends Controller
{
    public function index() {
        return view('permission.index');
    }

    public function table() {
        $data = Permission::with(['menu' => function($q){
            $q->select('menu_id', 'menu_name');
        }]);

        return DataTables::of($data)
            ->addColumn('action', function($data){
                return '<a href="'. route('permission') .'/'. $data->permission_id .'" class="btn btn-sm btn-default mr-2"><i class="fa fa-edit"></i></a>'
                    . '<button class="btn btn-sm btn-danger btn-delete" value="'. $data->permission_id .'"><i class="fa fa-trash"></i></button>';
            })
            ->make(true);
    }

    public function create() {
        $menu = Menu::orderBy('menu_name')->get();
        return view('permission.create', compact('menu'));
    }

    public function store(PermissionRequest $request) {
        Permission::create([
            'menu_id' => $request->menu,
            'permission_name' => $request->permission_name
        ]);

        return redirect('permission')->with('success', 'Permission ' . $request->permission_name . ' berhasil disimpan');
    }

    public function edit($id) {
        $permission = Permission::find($id);
        if ($permission == null) abort(404);
        $menu = Menu::orderBy('menu_name')->get();
        return view('permission.edit', compact('menu', 'permission'));
    }

    public function update(PermissionRequest $request, $id) {
        $permission = Permission::find($id);
        if ($permission == null) abort(404);
        $permission->update([
            'menu_id' => $request->menu,
            'permission_name' => $request->permission_name
        ]);
        return redirect('permission')->with('success', 'Permission ' . $request->permission_name . ' berhasil diperbaharui');
    }

    public function destroy($id) {
        Permission::destroy($id);
        return response()->json('Permission berhasil dihapus', 200);
    }
}
