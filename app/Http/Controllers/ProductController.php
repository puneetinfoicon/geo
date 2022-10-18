<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\SearchCategory;
use App\Models\Product;
use App\Models\Context;
use App\Models\Area;
use App\Models\SubProdukter;
use App\Models\Produkter;
use App\Models\RelatedArea;
use App\Models\ProductImage;
use DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->apiToken = "Bearer " . env('TOKEN');
    }

    public function list()
    {
        // return view('admin.add_products', ['categories' => $categories]);
    }

    public function addProducts()
    {
        $categories = Category::all();
        return view('admin.add_products', ["categories" => $categories]);
    }

    // public function submitProducts(Request $request)
    // {

    //     $product = insertProducts($request);

    //     session()->flash('alert-class', 'success');
    //     session()->flash('message', $product['message']);

    //     return redirect($product['redirect']);
    // }

    public function productsLists()
    {
        // $products = Product::with(['imagess', 'categoriess', 'subcategoriess', 'getQuantity'])->paginate(20);
        $products = Product::orderBy('created_at', 'desc')->where('delete_status',0)->get();
//        $products = Product::orderBy('created_at', 'desc')->paginate(20);


        $count = 0;
        if (isset($_GET['page'])) {
            $count = ($_GET['page'] - 1) * 20;
        }
        return view('admin.products.view_products', ['products' => $products, 'count' => $count]);
    }

    public function editProducts($productId)
    {
        $product = Product::with(['imagess', 'accessoriess'])->where('id', $productId)->first();
        $categories = Category::get();
        $searchCategories = SearchCategory::get();
        $areas = Area::get();
        $allProducts = Product::where('is_subscription', '<>', '1')->get();
//        $allProducts = Product::get();
        $contexts = Context::get();
        $productCategories = $product->categories->pluck('id')->toArray();
        $productAreas = $product->areas->pluck('id')->toArray();
        $productContexts = $product->contexts->pluck('id')->toArray();
        $productTilbehors = $product->accessoriess->pluck('relatedProduct')->toArray();
        $productMtilbehors = $product->maccessoriess->pluck('relatedProduct')->toArray();
        $productPassers = $product->passerss->pluck('relatedProduct')->toArray();
        $productSearchCategories = $product->search_categories->pluck('id')->toArray();
        $productImages = $product->imagess;
        $images = \DB::table('pagebuilder__uploads')->get();
        $relatedArea = $product->relatedArea->pluck('area_id')->toArray();

        return view('admin.products.edit_product', ['product' => $product,
            "categories" => $categories,
            'searchCategories' => $searchCategories,
            'areas' => $areas,
            'contexts' => $contexts,
            'allProducts' => $allProducts,
            'productCategories' => $productCategories,
            'productSearchCategories' => $productSearchCategories,
            'productAreas' => $productAreas,
            'productContexts' => $productContexts,
            'productTilbehors' => $productTilbehors,
            'productMtilbehors' => $productMtilbehors,
            'productPassers' => $productPassers,
            'productImages' => $productImages,
            'images' => $images,
            'relatedArea' => $relatedArea,
        ]);
    }

    public function updateProducts(Request $request)
    {
        try {
            $size = 4072;
            $validator = \Validator::make($request->all(), [
//                'images.*' => "mimes:jpeg,jpg,png,gif,mp4,mpegURL,mov,ogg,qt|max:$size",
                'id' => 'required|max:255|exists:products,id',
                'short_text' => 'required',
                'description' => 'required',
                'specfication' => 'required',
                'inholder' => 'required',
                'categories.*' => 'required|max:255|exists:categories,id',
                'searchCategories.*' => 'required|max:255|exists:search_categories,id',
                // 'tilbehor.*' => 'required|max:255|exists:products,id',
                //'passer.*' => 'required|max:255|exists:products,id',
                // 'contexts.*' => 'required|max:255|exists:contexts,id',
                'areas.*' => 'required|max:255|exists:areas,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput($request->all())->withError($validator->errors()->first());
            }

            $product = update_edit_products($request);
            session()->flash('alert-class', 'success');
            session()->flash('message', $product['message']);
            return redirect($product['redirect']);
        }catch (\Exception $e){
            return redirect()->back()->withInput($request->all())->withError($e->getMessage());
        }
    }

    public function deleteProduct($productId)
    {
        $product = Product::with(['imagess'])->where('id', $productId)->first();
        $oldImages = $product->imagess;
        foreach ($oldImages as $key => $image) {
            $public = 'public/' . $image->url;
            $storage = storage_path('app/' . $image->url);
            removeFile($public);
            removeFile($storage);
        }
        $product->delete();
        session()->flash('alert-class', 'success');
        session()->flash('message', "Product deleted successfully.");
        return redirect("/admin/ecommerce-products-list");
    }

    public function deleteProductImage(Request $request)
    {
        $result = removeProductImage($request);
        return response()->json(['result' => $result, 'request' => $request->all()]);
        // return response()->json(['result'=>[],'request' => $request['id']]);
    }


    public function produktersLists()
    {
        $categories = getAllProdukters();
        $areas = getAllAreas();
        $productAreas = array();
        return view('admin.produkters.add_produkter', ['categories' => $categories, 'areas' => $areas, 'productAreas' => $productAreas]);
    }

    public function editProdukter($id)
    {
        $produkter = Produkter::find($id);
        $productAreas = $produkter->areas->pluck('id')->toArray();
        $areas = getAllAreas();
        return view('admin.produkters.edit_produkter', ['produkter' => $produkter, 'productAreas' => $productAreas, 'areas' => $areas,]);
    }


    public function updateProdukter(Request $request)
    {
        $categories = updateProdukter($request);
        session()->flash('alert-class', 'success');
        session()->flash('message', $categories['message']);
        return redirect($categories['redirect']);
    }

    public function deleteProdukter($id)
    {
        $product = Produkter::where('id', $id)->delete();
        session()->flash('alert-class', 'success');
        session()->flash('message', "Produkter deleted successfully.");
        return redirect()->back();
    }

    public function submit_produkter(Request $request)
    {
        $categories = insertProdukter($request);
        session()->flash('alert-class', 'success');
        session()->flash('message', $categories['message']);
        return redirect($categories['redirect']);
    }

    public function subProdukter($produkterId)
    {
        $produkter = Produkter::find($produkterId);
        $categories = $produkter->subProdukterss()->paginate(20);
        return view('admin.produkters.add_sub_produkter', ['categories' => $categories, 'produkterId' => $produkterId, 'name' => $produkter->name]);
    }

    public function submitSubProdukter(Request $request)
    {
        $categories = insertSubProdukter($request);
        session()->flash('alert-class', 'success');
        session()->flash('message', $categories['message']);
        //return redirect($categories['redirect']);
        return redirect('/admin/ecommerce-produkters-list');
    }

    public function editSubProdukter($subProdukterId)
    {
        $subProdukter = SubProdukter::find($subProdukterId);
        return view('admin.produkters.edit_sub_produkter', ['subProdukter' => $subProdukter]);
    }

    public function postSubProdukter(Request $request)
    {
        $categories = updateSubProdukter($request);
        session()->flash('alert-class', 'success');
        session()->flash('message', $categories['message']);
        return redirect('/admin/ecommerce-produkters-list');
    }

    public function deleteSubProdukter($id)
    {
        $product = SubProdukter::where('id', $id)->first();
        $product->delete();
        session()->flash('alert-class', 'success');
        session()->flash('message', "Sub-produkter deleted successfully.");
        return redirect("/admin/ecommerce-produkters-list");
    }

    public function changeImage(Request $request)
    {
        DB::table('product_images')->where('product_id', $request->productId)->delete();

        $image = json_decode($request->img);
        // $images = array_slice($image,0,count($image)-1);
        $type = json_decode($request->type);
        //$types = array_slice($type,0,count($type)-1);
        foreach ($image as $key => $img) {
            $imgType = $type[$key];
          $explode =  explode('pagebuilder/uploads/',$img);
          $imgDetails = \DB::table('pagebuilder__uploads')->where('server_file',$explode[1])->first();
//           print_r($explode[1]);
            DB::table('product_images')->insert(['url' => 'pagebuilder/uploads/'.$imgDetails->server_file, 'type' => $imgType, 'product_id' => $request->productId,'title_image'=>$imgDetails->title_image,'alt_image'=>$imgDetails->alt_image]);
        }
        return DB::table('product_images')->where('product_id', $request->productId)->get();
    }

    public function deleteAllImage(Request $request)
    {
        return deleteAllProductImg($request->productId);
    }

    public function add_variant(Request $request)
    {
        $data['categories'] = Category::get();
        $data['searchCategories'] = SearchCategory::get();
        $data['areas'] = Area::get();
        $data['allProducts'] = Product::where('is_subscription', '<>', '1')->get();
//        $data['allProducts'] = Product::where('type','Subscription')->where('is_subscription','<>','1')->get();
        $data['contexts'] = Context::get();
        $data['images'] = \DB::table('pagebuilder__uploads')->get();
        return view('admin.products.add-variant', $data);
    }

    public function submitVariantProduct(Request $request)
    {
        try {
            $size = 4072;
            $validator = \Validator::make($request->all(), [
//                'images.*' => "mimes:jpeg,jpg,png,gif,mp4,mpegURL,mov,ogg,qt|max:$size",
                'short_text' => 'required',
                'description' => 'required',
                'specfication' => 'required',
                'inholder' => 'required',
               // 'contexts' => 'required|array',
                'areas' => 'required|array',
//            'label_name' => 'required|array',
//            'varProductId' => 'required|array',

            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput($request->all())->withError($validator->errors()->first());
            }
            $product = add_variant_products($request);
            session()->flash('alert-class', 'success');
            session()->flash('message', $product['message']);
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->all())->withError($e->getMessage());
        }
    }

    public function getProduktPrice(Request $request)
    {
        $product = Product::where('id', $request->id)->get();
        $products = Product::where('id', $request->id)->first();
        if ($products->hide_amount !='1'){
            if (is_array(getProductAPpiObj($product))) {
                return ['status' => 'true', 'data' => getProductAPpiObj($product)[0],'type'=>$products->type];
            } else {
                return ['status' => 'false', 'data' => getProductAPpiObj($product),'type'=>$products->type];
            }
        }else{
            return ['status' => 'false', 'data' => ['message'=>'Ring for en pris'],'type'=>$products->type];
        }

    }

    public function sim_products(Request $request)
    {
        $data['products'] = Product::where('type','SIM')->get();
        $data['custom'] = \DB::table('custom_sim')->where('id',1)->first();
        return view('admin.products.sim-products',$data);
    }

    public function productStatus(Request $request)
    {
        if ($request->api_id == "static"){
            \DB::table('custom_sim')->where('id',1)->update(['status'=>$request->status]);
        }else{
            Product::where('api_id',$request->api_id)->update(['status'=>$request->status]);
        }
    }
    public function productAskSim(Request $request)
    {
        if ($request->api_id == "static"){
            \DB::table('custom_sim')->where('id',1)->update(['ask_sim'=>$request->ask_sim]);
        }else{
            Product::where('api_id',$request->api_id)->update(['ask_sim'=>$request->ask_sim]);
        }
    }

    public function productSimStatus(Request $request)
    {
        if ($request->api_id == "static"){
          return  \DB::table('custom_sim')->where('id',1)->where('id',1)->first()->ask_sim;
        }else{
           return Product::where('api_id',$request->api_id)->first()->ask_sim;
        }
    }

    public function getVariantSim(Request $request)
    {
        $explode = [];
        $variantProduct = Variant::where('varProduct_id',$request->product_id)->where('product_id',$request->api_id)->first();
        if ($variantProduct->sims != null){
            $explode = explode(',',$variantProduct->sims);
        }
        if (sizeof($explode)>0){
            $sims =  Product::select('id','api_id','api_name')->whereIn('api_id',$explode)->get();
            echo '<select class="form-control productEvents" id="mySelect2" ><option value="">Vælg SIM-kort</option>';
            $customSim = getAllCustomSim();
            if (isset($customSim->id)){
                echo "<option value='static'>".$customSim->simkort."</option>";
            }
            if (sizeof($sims)>0){
                foreach ($sims as $sim){
                    echo "<option value='$sim->api_id'>".$sim->api_name."</option>";
                }
            }
            echo "</select><script src='".url('assets/js/custom-select.js')."'></script>";
        }
    }
}
