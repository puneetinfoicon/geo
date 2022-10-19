<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    public function index()
    {
        $areas = getAllAreas();

        return view('admin.areas', ['areas' => $areas]);
    }

    public function submitArea(Request $request)
    {
        $categories = insertArea($request);

        session()->flash('alert-class', 'success');
        session()->flash('message', $categories['message']);

        return redirect($categories['redirect']);
    }

    public function editArea($id)
    {
        $areas = Area::find($id);
        return view('admin.edit_areas', ['category' => $areas]);
    }

    public function updateArea(Request $request)
    {
        $areas = updateArea($request);

        session()->flash('alert-class', 'success');
        session()->flash('message', $areas['message']);

        return redirect($areas['redirect']);
    }

    public function deleteArea($categoryId){
        Area::where('id', $categoryId)->delete();
        session()->flash('alert-class', 'success');
        session()->flash('message', "Area deleted successfully.");

        return redirect("/admin/ecommerce-areas");
    }
}
