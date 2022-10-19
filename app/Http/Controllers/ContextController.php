<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Context;
use App\Models\Category;
use App\Models\SearchCategory;
use App\Models\Area;

class ContextController extends Controller
{
    public function index()
    {
        $context    = getAllContext();
        $allContext = getAllContextWithoutPage();
        $categories = Category::get();
        $searchCategories = SearchCategory::get();
        $pages = \DB::table('pagebuilder__pages')->select('id','name')->where(['status'=>'1','guide'=>'1'])->get();
        $areas = Area::get();
        return view('admin.context', [  'contexts'          => $context,
                                        'allContext'        => $allContext,
                                        'categories'        => $categories,
                                        'searchCategories'  => $searchCategories,
                                        'pages'             => $pages,
                                        'areas'             => $areas,]);
    }

    public function getGuidePage(Request $request)
    {
       $type = $request->type;
       if ($type == "guide"){
           return \DB::table('pagebuilder__pages')->select('id','name')->where(['status'=>'1','guide'=>'1'])->get();
       }else{
           return \DB::table('pagebuilder__pages')->select('id','name')->where(['status'=>'1','guide'=>'0'])->get();
       }
    }

    public function submitContext(Request $request)
    {
        $categories = insertContext($request);

        session()->flash('alert-class', 'success');
        session()->flash('message', $categories['message']);

        return redirect($categories['redirect']);
    }

    public function editContext ($id)
    {
        $context            = Context::find($id);
        $allContext         = getAllContextWithoutPage();
        $categories         = Category::get();
        $searchCategories   = SearchCategory::get();
        $areas              = Area::get();
        $pages = \DB::table('pagebuilder__pages')->select('id','name')->where(['status'=>'1','guide'=>'1'])->get();

        $productCategories          = $context->categories->pluck('id')->toArray();
        $productAreas               = $context->areas->pluck('id')->toArray();
        $productSearchCategories    = $context->search_categories->pluck('id')->toArray();
        return view('admin.edit_context', [ 'category'                  => $context,
                                            'allContext'                => $allContext,
                                            'categories'                => $categories,
                                            'searchCategories'          => $searchCategories,
                                            'areas'                     => $areas,
                                            'productAreas'              => $productAreas,
                                            'productCategories'         => $productCategories,
                                            'productSearchCategories'   => $productSearchCategories,
                                            'pages'                     => $pages,
                                        ]);
    }

    public function updateContext(Request $request)
    {
        $areas = updateContext($request);

        session()->flash('alert-class', 'success');
        session()->flash('message', $areas['message']);

        return redirect($areas['redirect']);
    }

    public function deleteContext($categoryId){
//        Context::where('id', $categoryId)->delete();
        $context = Context::where('id', $categoryId)->first();
        $storage = storage_path('app/'. $context->file_url);
//        removeFile('public/' . $context->file_url);
//        removeFile($storage);
        $context->delete();
        session()->flash('alert-class', 'success');
        session()->flash('message', "Content deleted successfully.");

        return redirect("/admin/ecommerce-content");
    }
}
