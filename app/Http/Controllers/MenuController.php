<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use DataTables;

class MenuController extends Controller
{
    public function index() {
        return view('menu.index');
    }

    public function table() {
        $data = Menu::with(['group' => function($q){
                $q->select('menu_id', 'menu_name');
            }]);
        return DataTables::of($data)
            ->editColumn('groupmenu', function($data){
                return $data->group->menu_name ?? 'Menu Utama';
            })
            ->editColumn('icon', function($data){
                return $data->icon == null ? '' : ('<i class="'. $data->icon .'"></i> ' . $data->icon);
            })
            ->addColumn('action', function($data){
                return '<a href="'. route('menu') .'/'. $data->menu_id .'" class="btn btn-sm btn-default mr-2"><i class="fa fa-edit"></i></a>'
                    . '<button class="btn btn-sm btn-danger btn-delete" value="'. $data->menu_id .'"><i class="fa fa-trash"></i></button>';
            })
            ->rawColumns(['action', 'icon'])
            ->make('true');
    }

    public function create() {
        $groupmenu = Menu::getGroupmenu();
        return view('menu.create', compact('groupmenu'));
    }

    public function store(MenuRequest $request) {
        $request->validated();
        Menu::create([
            'menu_name' => $request->menu_name,
            'link' => $request->link,
            'icon' => $request->icon,
            'groupmenu' => $request->groupmenu,
            'ordinal' => $request->ordinal,
            'state' => $request->state
        ]);
        return redirect('menu')->with('success', 'Menu ' . $request->menu_name . ' berhasil disimpan');
    }

    public function edit($id) {
        $menu = Menu::find($id);
        if ($menu == null) abort(404);
        $groupmenu = Menu::getGroupmenu();
        return view('menu.edit', compact('groupmenu', 'menu'));
    }

    public function update(MenuRequest $request, $id) {
        $request->validated();
        Menu::find($id)->update([
            'menu_name' => $request->menu_name,
            'link' => $request->link,
            'icon' => $request->icon,
            'groupmenu' => $request->groupmenu,
            'ordinal' => $request->ordinal,
            'state' => $request->state
        ]);
        return redirect('menu')->with('success', 'Menu ' . $request->menu_name . ' berhasil diperbaharui');
    }

    public function destroy($id) {
        $menu = Menu::find($id);
        $menu->delete();
        return response()->json($menu->menu_name . ' berhasil dihapus');
    }
}
