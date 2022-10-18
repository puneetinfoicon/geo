<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Submenu;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $data['menus'] = Menu::all();
        return view('admin.header.menu',$data);
    }

    public function submit_menus(Request $request)
    {
        $menus = insertMenu($request);
        session()->flash('alert-class', 'success');
        session()->flash('message', $menus['message']);

        return redirect($menus['redirect']);
    }

    public function edit_menu(Request $request, $id)
    {
        $data['details'] = Menu::find($id);
        return view('admin.header.edit-menu',$data);
    }

    public function update_menus(Request $request, $id)
    {
        $menus = updateMenu($request, $id);
        session()->flash('alert-class', 'success');
        session()->flash('message', $menus['message']);
        return redirect($menus['redirect']);
    }

    public function delete_menu(Request $request, $id)
    {
        $menus = deleteMenu($request, $id);
        session()->flash('alert-class', 'success');
        session()->flash('message', $menus['message']);
        return redirect($menus['redirect']);
    }


    public function submenus(Request $request, $id)
    {
        $data['submenus'] = Submenu::where('menu_id',$id)->get();
        $data['details'] = Menu::find($id);
        return view('admin.header.submenu',$data);
    }

    public function submit_submenus(Request $request)
    {
        $menus = insertSubMenu($request);
        session()->flash('alert-class', 'success');
        session()->flash('message', $menus['message']);

        return redirect($menus['redirect']);
    }

    public function edit_submenu(Request $request, $id)
    {
        $data['details'] = Submenu::with('menuss')->find($id);
        return view('admin.header.submenuEdit',$data);
    }

    public function update_submenus(Request $request, $id)
    {
        $menus = updateSubMenu($request, $id);
        session()->flash('alert-class', 'success');
        session()->flash('message', $menus['message']);

        return redirect($menus['redirect']);
    }

    public function delete_submenu(Request $request, $id, $menuId)
    {
        $menus = deleteSubmenu($request, $id, $menuId);
        session()->flash('alert-class', 'success');
        session()->flash('message', $menus['message']);
        return redirect($menus['redirect']);
    }
}
