<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AjaxController extends Controller
{
    public function sub_categories(Request $request)
    {
        
        $category   = Category::find($request->categoryId);
        $success    = true;

        if (sizeof($category->subcategoriess) == 0) {
            $success    = false;
        }
        
        return response()->json(['success'          => $success,
                                 'subCategories'    => $category->subcategoriess]);
    }
}
