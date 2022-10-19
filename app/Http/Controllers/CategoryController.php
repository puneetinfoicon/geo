<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\SearchCategory;
use App\Models\Subcategory;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = getAllCategories();

        return view('admin.categories', ['categories' => $categories]);
    }


    public function search_categories()
    {
        $categories = getAllSearchCategories();

        return view('admin.search_categories', ['categories' => $categories]);
    }

    public function editCategories($categoryId)
    {
        $categories = Category::find($categoryId);

        return view('admin.edit_categories', ['category' => $categories]);
    }

    public function editSearchCategories($categoryId)
    {
        $categories = SearchCategory::find($categoryId);
        return view('admin.edit_search_categories', ['category' => $categories]);
    }

    public function postCategories(Request $request)
    {
        $categories = updateCategory($request);

        session()->flash('alert-class', 'success');
        session()->flash('message', $categories['message']);

        return redirect($categories['redirect']);
    }

    public function updateSearchCategories(Request $request)
    {
        $categories = updateSearchCategory($request);

        session()->flash('alert-class', 'success');
        session()->flash('message', $categories['message']);

        return redirect($categories['redirect']);
    }

    public function sub_categories($categoryId)
    {
        $category = Category::find($categoryId);

        return view('admin.sub_categories.sub_categories', ['category' => $category]);
    }

    public function submitCategories(Request $request)
    {
        $categories = insertCategories($request);

        session()->flash('alert-class', 'success');
        session()->flash('message', $categories['message']);

        return redirect($categories['redirect']);
    }

    public function submit_search_categories(Request $request)
    {
        $categories = insertSearchCategories($request);

        session()->flash('alert-class', 'success');
        session()->flash('message', $categories['message']);

        return redirect($categories['redirect']);
    }

    public function submitSubCategories(Request $request)
    {
        $categories = insertSubCategories($request);

        session()->flash('alert-class', 'success');
        session()->flash('message', $categories['message']);

        return redirect($categories['redirect']);
    }

    public function editSubcategories($subCategoryId)
    {
        $subCategory = Subcategory::find($subCategoryId);

        return view('admin.sub_categories.edit_sub_categories', ['subCategory' => $subCategory]);
    }

    public function postSubCategories(Request $request)
    {
        $categories = updateSubCategory($request);

        session()->flash('alert-class', 'success');
        session()->flash('message', $categories['message']);

        return redirect($categories['redirect']);
    }

    public function deleteCategory($categoryId)
    {
        $category = Category::where('id', $categoryId)->first();
        $oldImages = $category->image;
        $public = 'public/' . $oldImages;
        $storage = storage_path('app/'. $oldImages);
        removeFile($public);
        removeFile($storage);

        Category::where('id', $categoryId)->delete();
        session()->flash('alert-class', 'success');
        session()->flash('message', "Product Category deleted successfully.");

        return redirect("/admin/ecommerce-products-categories");
    }

    public function deleteSearchCategory($categoryId)
    {
        SearchCategory::where('id', $categoryId)->delete();
        session()->flash('alert-class', 'success');
        session()->flash('message', "Search Category deleted successfully.");

        return redirect("/admin/ecommerce-search-categories");
    }

    // echo "<pre>"; print_r($request->all()); echo "</pre>";
    // echo "<pre>"; print_r($categories); echo "</pre>";
}
