<?php

use App\Models\Newsletter;
use Illuminate\Support\Facades\Http;
use App\Models\SearchCategory;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\UserProduct;
use App\Models\Content;
use App\Models\Footer;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\Area;
use App\Models\Context;
use App\Models\Team;
use App\Models\SubProdukter;
use App\Models\Faq;
use App\Models\Gpsnetorganization;
use App\Models\Homevideo;
use App\Models\Produkter;
use App\Models\Service;
use App\Models\ShareCart;
use App\Models\StaticContent;
use App\Models\Maccessories;
use App\Models\Maccessory;
use App\Models\RelatedArea;
use App\Models\Accessory;
use App\Models\Cart;
use App\Models\Variant;
use App\Models\ServiceContext;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


/*******  Use Post API's *********/

function postApi($url, $array)
{
    $token = env('TOKEN');
    if (Session::get('api_token')) {
        $token = Session::get('api_token');
    }

    $api_url = env('BASE_API_URL');
    $response = Http::withToken($token)->post($api_url . $url, $array);

    // return json_decode($response);
    if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
        return $data ['result'] = json_decode($response);
    } else {
        return $data ['result'] = $response;
    }

}

function patchApi($url, $array)
{
    $token = env('TOKEN');
    if (Session::get('api_token')) {
        $token = Session::get('api_token');
    }

    $api_url = env('BASE_API_URL');
    $response = Http::withToken($token)->patch($api_url . $url, $array);
    // return json_decode($response);
    if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
        return $data ['result'] = json_decode($response);
    } else {
        return $data ['result'] = $response;
    }

}

function getApi($url, $array = null)
{
    $token = env('TOKEN');
    if (Session::get('api_token')) {
        $token = Session::get('api_token');
        // dd($token);
    }
    $api_url = env('BASE_API_URL');
    //dd($api_url . $url);
    return $result = Http::withToken($token)->get($api_url . $url, $array);
}

function deleteApi($url, $array = null)
{
    $token = env('TOKEN');
    if (Session::get('api_token')) {
        $token = Session::get('api_token');
    }
    $api_url = env('BASE_API_URL');
    return $result = Http::withToken($token)->delete($api_url . $url);
}

function getProductPrice()
{
    if (Session::get('api_token')) {
        $token = Session::get('api_token');
        $tokenParts = explode(".", $token);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);
        foreach ($tokenParts as $key => $part) {
            $data[] = json_decode(base64_decode($part));
        }
        return $data;
    }
}

function getUserType($token)
{
    $tokenParts = explode(".", $token);
    $tokenHeader = base64_decode($tokenParts[0]);
    $tokenPayload = base64_decode($tokenParts[1]);
    $jwtHeader = json_decode($tokenHeader);
    $jwtPayload = json_decode($tokenPayload);
    foreach ($tokenParts as $key => $part) {
        $data[] = json_decode(base64_decode($part));
    }
    return $data;
}

function checkAdmin($token)
{
    if ($token == null) {
        return redirect('/admin/logout');
    }
    $tokenParts = explode(".", $token);
    $tokenHeader = base64_decode($tokenParts[0]);
    if (!isset($tokenParts[1])){

    }
    $tokenPayload = base64_decode($tokenParts[1]);
    $jwtHeader = json_decode($tokenHeader);
    $jwtPayload = json_decode($tokenPayload);
    foreach ($tokenParts as $key => $part) {
        $data[] = json_decode(base64_decode($part));
    }
    return $data[1]->GeoteamAdmin;
}

if (!function_exists('userProfile')) {
    function userProfile()
    {

    }
}

if (!function_exists('testHelper')) {
    function testHelper()
    {
        $data = DB::table('users')->get();
        return $data;
    }
}

if (!function_exists('userAdminLogin')) {
    function userAdminLogin($request)
    {
        $email = $request->email;
        $password = $request->password;
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            $success['redirect'] = "/login-register";
            return $success;
        }

        $credentials = array('email' => $email, 'password' => $password);

        if (Auth::attempt($credentials, false)) {
//            $array = ['loginName' => 'fih@le34.dk', 'password' => 'SuperSafePwd22!'];
//            $response = postApi('Authentication/SignIn', $array);
//            $json = $response;
//            if (!empty($json) && isset($json->token)) {
//                Session::put('api_token', $json->token);
//            }
            // Session::put('api_token', env('TOKEN'));
            $success['success'] = 1;
            $success['message'] = "User loged in successfully.";
            $success['redirect'] = "/admin";
        } else {
            $success['success'] = 0;
            $success['message'] = "Incorrect username/password combination";
            $success['redirect'] = "/login-register";
        }


    }
}

if (!function_exists('createAccount')) {
    function createAccount($request)
    {
        $email = $request->email;
        $password = $request->password;
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required',
            'name' => 'required',
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            $success['redirect'] = "/login-register";
            return $success;
        }

        $data = array(
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $customer = Role::where('slug', 'customer')->first();
        $user = User::create($data);
        $user->roles()->attach($customer);

        $verifyData = array('token' => Str::random(40));
        $user->verificationss()->create($verifyData);

        sendVerificationMail($user, $verifyData['token']);

        $success['success'] = 1;
        $success['message'] = "You are Registered Successfully. Please Login.";
        $success['redirect'] = "/login-register";

        return $success;
    }
}

if (!function_exists('sendVerificationMail')) {
    function sendVerificationMail($user, $token)
    {
        $url = url("/verify/$token");
        $body = getVerifyBody($url);

        $details = [
            'body' => $body,
            'to' => $user->email,
            'subject' => 'Geoteam - Confirm Your Registration',
            'name' => $user->name,
        ];

        Mail::to($details['to'])->send(new \App\Mail\MyTestMail($details));
    }
}

if (!function_exists('getVerifyBody')) {
    function getVerifyBody($url)
    {
        $body = "<p style='font-family: Roboto, Arial, sans-serif;font-size: 14px;color: #767676; margin: 0;margin-bottom: 14px;line-height: 22px'>Please click <a href='" . $url . "' style='text-decoration: none;color: #03a9f4;'>here</a> to verify your email address. If you did not create an account, no further action is required.</p>";

        return $body;
    }
}

if (!function_exists('getAllCategories')) {
    function getAllCategories()
    {
        $categories = Category::orderBy('rank', 'ASC')->paginate(200);
        return $categories;
    }
}

if (!function_exists('getAllFaqs')) {
    function getAllFaqs()
    {
        $produkter = Faq::orderBy('id', 'ASC')->paginate(20);
        return $produkter;
    }
}

if (!function_exists('insertFaq')) {
    function insertFaq($request)
    {
        $success['success'] = 1;
        $success['message'] = "FAQ added successfully.";
        $success['redirect'] = "/admin/faqs";

        $validator = Validator::make($request->all(), [
            'question' => "required",
            'answer' => 'required',
            'areas.*' => 'required|exists:areas,id',
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $category = new Faq();
        $category->question = $request->question;
        $category->answer = $request->answer;
        $category->created_at = date('Y-m-d H:i:s');
        $category->updated_at = date('Y-m-d H:i:s');

        if ($request->status != null && isset($request->status)) {
            $category->status = "$request->status";
        } else {
            $category->status = "0";
        }

        $category->save();

        insertFaqAreas($request->areas, $category);
        return $success;
    }
}

if (!function_exists('insertFaqAreas')) {

    function insertFaqAreas($cat, $product)
    {
        $categories = Area::whereIn('id', $cat)->get();

        $product->areas()->detach();
        foreach ($categories as $key => $category) {
            $product->areas()->attach($category);
        }
    }
}

if (!function_exists('getProductDetailsWithParam')) {

    function getProductDetailsWithParam($productIds)
    {
        foreach ($productIds as $ids) {
            $api_id[] = $ids['api_id'];
        }

        $result = array();
        $result['products'] = Product::whereIn('api_id', $api_id)->where('status', '1')->get();
        $productApiPrices = getProductAPpiObj($productIds, $customerNo = null, $qty = 1);
//        $productApiPrices = getProductAPpiObj($result['products']);
        // echo "<pre>"; print_r($productApiPrices); die;
//        if (!isset($productApiPrices->errorCode)) {
        if (!isset($productApiPrices->message)) {
            foreach ($productApiPrices as $product) {
                $result['productApiPrices'][$product->productNumber] = $product;
            }
        }
        return $result;
    }
}

if (!function_exists('getAllProdukters')) {
    function getAllProdukters()
    {
        $produkter = Produkter::orderBy('rank', 'ASC')->paginate(20);
        return $produkter;
    }
}


if (!function_exists('getAllCategories1')) {
    function getAllCategories1()
    {
        $categories = Category::all();

        return $categories;
    }
}

if (!function_exists('getAllProdukters')) {
    function getAllProdukters()
    {
        $categories = Produkter::all();
        return $categories;
    }
}

if (!function_exists('getAllGpsOrganisations')) {
    function getAllGpsOrganisations()
    {
        $organisations = Gpsnetorganization::all();
        return $organisations;
    }
}

if (!function_exists('insertCategories')) {
    function insertCategories($request)
    {
        $success['success'] = 1;
        $success['message'] = "Category added successfully.";
        $success['redirect'] = "/admin/ecommerce-products-categories";

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:categories,name',
            'rank' => 'required|max:255|unique:categories,rank',
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $url = "";
        if ($request->file('icon') != null) {
            $url = uploadFile($request->icon);
        }

        $category = new Category();
        $category->name = $request->name;
        $category->rank = $request->rank;
        $category->description = $request->description;
        $category->image = $url;
        $category->created_at = date('Y-m-d H:i:s');
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        return $success;
    }
}

if (!function_exists('insertSubMenu')) {
    function insertSubMenu($request)
    {
        $success['success'] = 1;
        $success['message'] = "Sub Menu added successfully.";
        $success['redirect'] = "/admin/dynamic-header";

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:submenus,name',
            'menu_id' => 'required',
            'url' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $category = new Submenu();
        $category->name = $request->name;
        $category->menu_id = $request->menu_id;
        $category->url = $request->url;
        $category->status = $request->status;
        $category->created_at = date('Y-m-d H:i:s');
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        return $success;
    }
}


if (!function_exists('updateSubMenu')) {
    function updateSubMenu($request, $id)
    {
        $success['success'] = 1;
        $success['message'] = "Sub Menu added successfully.";
        $success['redirect'] = "/admin/dynamic-header";

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:submenus,name,' . $id,
            'menu_id' => 'required',
            'url' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $category = Submenu::find($id);
        $category->name = $request->name;
        $category->menu_id = $request->menu_id;
        $category->url = $request->url;
        $category->status = $request->status;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        return $success;
    }
}

if (!function_exists('insertMenu')) {
    function insertMenu($request)
    {
        $success['success'] = 1;
        $success['message'] = "Menu added successfully.";
        $success['redirect'] = "/admin/dynamic-header";

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:menus,name',
            'url' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $category = new Menu();
        $category->name = $request->name;
        $category->status = $request->status;
        $category->url = $request->url;
        $category->created_at = date('Y-m-d H:i:s');
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        return $success;
    }
}


if (!function_exists('updateMenu')) {
    function updateMenu($request, $id)
    {
        $success['success'] = 1;
        $success['message'] = "Menu updated successfully.";
        $success['redirect'] = "/admin/dynamic-header";

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:menus,name,' . $id,
            'url' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $category = Menu::find($id);
        $category->name = $request->name;
        $category->url = $request->url;
        $category->status = $request->status;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        return $success;
    }
}
if (!function_exists('deleteMenu')) {
    function deleteMenu($request, $id)
    {
        $success['success'] = 1;
        $success['message'] = "Menu deleted successfully.";
        $success['redirect'] = "/admin/dynamic-header";
        Menu::where(['id' => $id])->delete();
        return $success;
    }
}
if (!function_exists('deleteSubmenu')) {
    function deleteSubmenu($request, $id, $menuId)
    {
        $success['success'] = 1;
        $success['message'] = "Menu deleted successfully.";
        $success['redirect'] = "/admin/dynamic-header";
        Submenu::where(['id' => $id])->delete();
        return $success;
    }
}

if (!function_exists('insertSubCategories')) {
    function insertSubCategories($request)
    {
        $success['redirect'] = "/admin/dynamic-header";
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:subcategories,name',
            'id' => 'required|max:255|exists:categories,id'
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $url = "";
        if ($request->file('icon') != null) {
            $url = uploadFile($request->icon);
        }

        $subcategory = new Subcategory();
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->id;
        $subcategory->image = $url;
        $subcategory->created_at = date('Y-m-d H:i:s');
        $subcategory->updated_at = date('Y-m-d H:i:s');
        $subcategory->save();

        $success['success'] = 1;
        $success['message'] = "Subcategory added successfully.";
        $success['redirect'] = "/admin/sub_categories/$request->id";
        return $success;
    }
}

if (!function_exists('getAllSubCategories')) {
    function getAllSubCategories($subCategoryId)
    {
        $subCategories = Subcategory::paginate(20);
        return $subCategories;
    }
}

if (!function_exists('uploadFile')) {
    function uploadFile($file, $request = null)
    {
        $curr_time = strtotime(date('Y-m-d H:i:s')) . rand(111111, 999999);
        $filename = $file->getClientOriginalName();
        $file->storeAs('pagebuilder/uploads/' . $curr_time . '/', $filename);
        $destinationPath = 'pagebuilder/uploads/' . $curr_time . '/' . $filename; // local storage
        $destiny = $curr_time . '/' . $filename; // local storage
        $file->move(public_path('pagebuilder/uploads/') . $curr_time . '/', $filename);
        $extension = explode('.', $filename);
        \DB::table('pagebuilder__uploads')->insert(['public_id' => $curr_time, 'original_file' => $filename, 'mime_type' => "image/" . end($extension), 'server_file' => $destiny]);
        return $destinationPath;
    }
}

if (!function_exists('updateCategory')) {
    function updateCategory($request)
    {
        $success['success'] = 1;
        $success['message'] = "Category updated successfully.";
        $success['redirect'] = "/admin/ecommerce-products-categories";
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'id' => 'required|max:255|exists:categories,id',
            'name' => "required|max:255|unique:categories,name,$id",
            'rank' => "required|max:255|unique:categories,rank,$id",
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->rank = $request->rank;
        $category->description = $request->description;

        if ($request->file('icon') != null) {
            $category->image = uploadFile($request->icon);
        }
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        return $success;
    }
}

if (!function_exists('updateSearchCategory')) {
    function updateSearchCategory($request)
    {
        $success['success'] = 1;
        $success['message'] = "Search Category updated successfully.";
        $success['redirect'] = "/admin/ecommerce-search-categories";

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:search_categories,name',
            'id' => 'required|max:255|exists:search_categories,id'
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $category = SearchCategory::find($request->id);
        $category->name = $request->name;
        // if ($request->file('icon') != null) {
        //     $category->image        = uploadFile($request->icon);
        // }
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        return $success;
    }
}

if (!function_exists('updateSubCategory')) {
    function updateSubCategory($request)
    {
        $success['success'] = 1;
        $success['message'] = "Subcategory updated successfully.";
        $success['redirect'] = "/admin/ecommerce-products-categories";

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:subcategories,name',
            'id' => 'required|max:255|exists:subcategories,id'
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $category = Subcategory::find($request->id);
        $category->name = $request->name;
        if ($request->file('icon') != null) {
            $category->image = uploadFile($request->icon);
        }
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        $success['redirect'] = "/admin/sub_categories/$category->category_id";
        return $success;
    }
}

// if (! function_exists('insertProducts')) {
//     function insertProducts($request)
//     {
//         $success['success']    =  1;
//         $success['message']    =  "Product added successfully.";
//         $success['redirect']   =  "/admin/ecommerce-products-list";

//         $validator      = Validator::make($request->all(), [
//             'name'          => 'required|max:255|unique:products,name',
//             'description'   => 'required',
//             'sku'           => 'required',
//             'categoryId'    => 'required|max:255|exists:categories,id',
//             'quantity'      => 'required',
//             'amount'        => 'required|regex:/^\d+(\.\d{1,2})?$/',
//             'images.*'      => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
//         ]);

//         if ($validator->fails()) {
//             $success['success']    =  3;
//             $success['message']    =  $validator->errors()->first();
//             $success['redirect']   =  "/admin/add_products";
//             return $success;
//         }

//         if ($request->subcategoryId != null && isset($request->subcategoryId)) {
//             $validator1      = Validator::make($request->all(), [
//                 'subcategoryId'    => 'required|max:255|exists:subcategories,id'
//             ]);


//             if ($validator1->fails()) {
//                 $success['success']    =  3;
//                 $success['message']    =  $validator1->errors()->first();
//                 $success['redirect']   =  "/admin/add_products";

//                 return $success;
//             }
//         }

//         $product                    = new Product();
//         $product->name              = $request->name;
//         $product->description       = $request->description;
//         $product->sku               = $request->sku;
//         $product->category_id       = $request->categoryId;
//         if ($request->subcategoryId != null && isset($request->subcategoryId) && $request->subCategoryFlag == 1 ) {
//             $product->sub_category_id   = $request->subcategoryId;
//         }
//         $product->amount            = $request->amount;
//         $product->status            = '0';
//         if ($request->status != null && isset($request->status)) {
//             $product->status   = "$request->status";
//         }

//         $product->created_at        = date('Y-m-d H:i:s');
//         $product->updated_at        = date('Y-m-d H:i:s');
//         $product->save();

//         $count  = 0;
//         foreach ($request->images as $key => $image) {

//             $data[$count]['product_id'] = $product->id;
//             $data[$count]['url']        = uploadFile($image);
//             $data[$count]['created_at'] = date('Y-m-d H:i:s');
//             $data[$count]['updated_at'] = date('Y-m-d H:i:s');

//             $count++;
//         }

//         ProductImage::insert($data);

//         $userProduct                = new UserProduct();
//         $userProduct->product_id    = $product->id;
//         $userProduct->user_id       = Auth::user()->id;
//         $userProduct->quantity      = $request->quantity;
//         $userProduct->created_at    = date('Y-m-d H:i:s');
//         $userProduct->updated_at    = date('Y-m-d H:i:s');
//         $userProduct->save();
//         return $success;
//     }
// }

if (!function_exists('date_formats')) {
    function date_formats($format, $month, $date, $year)
    {
        $date = date("$month/$date/$year");
        $date = date($format, strtotime($date));
        return $date;
    }
}

if (!function_exists('update_edit_products')) {
    function update_edit_products($request)
    {
        $success['success'] = 1;
        $success['message'] = "Product updated successfully.";
        $success['redirect'] = "/admin/ecommerce-products-list";

        $product = Product::with(['imagess'])->where('id', $request->id)->first();
        $product->short_text = $request->short_text;
        $product->description = $request->description;

        $product->meta_tag = $request->meta_tag;
        $product->meta_description = $request->meta_description;

        $product->inholder = $request->inholder;
        $product->specfication = $request->specfication;
        $product->specification2 = $request->specification2;
        $product->specification3 = $request->specification3;
        $product->specification4 = $request->specification4;

        $product->specification4_title = $request->specification4_title;
        $product->specification3_title = $request->specification3_title;
        $product->specification2_title = $request->specification2_title;
        $product->specification_title = $request->specification_title;
        $product->inholder_title = $request->inholder_title;

        $product->amount = 0;

        if ($request->status != null && isset($request->status)) {
            $product->status = "$request->status";
        } else {
            $product->status = "0";
        }

        if ($request->hide_amount != null && isset($request->hide_amount)) {
            $product->hide_amount = "$request->hide_amount";
        } else {
            $product->hide_amount = "0";
        }
        if ($request->is_subscription != null && isset($request->is_subscription)) {
            $product->is_subscription = "$request->is_subscription";
        } else {
            $product->is_subscription = "0";
        }
        if ($request->subscription_type_one != null && isset($request->subscription_type_one)) {
            $product->subscription_type_one = "$request->subscription_type_one";
        } else {
            $product->subscription_type_one = "0";
        }
        if ($request->subscription_type_two != null && isset($request->subscription_type_two)) {
            $product->subscription_type_two = "$request->subscription_type_two";
        } else {
            $product->subscription_type_two = "0";
        }
        if ($request->subscription_type_three != null && isset($request->subscription_type_three)) {
            $product->subscription_type_three = "$request->subscription_type_three";
        } else {
            $product->subscription_type_three = "0";
        }
        if ($request->subscription_type_trail != null && isset($request->subscription_type_trail)) {
            $product->subscription_type_trail = "$request->subscription_type_trail";
        } else {
            $product->subscription_type_trail = "0";
        }


        $product->updated_at = date('Y-m-d H:i:s');
        $product->save();

        if (isset($request->varProductId) && sizeof($request->varProductId) > 0) {
            Variant::where('varProduct_id', $request->id)->delete();
            foreach ($request->varProductId as $key => $varProduct) {
                $variant = new Variant();
                $variant->varProduct_id = $request->id;
                $variant->product_id = $varProduct;
                if (isset($request->sim[$key])) {
                    $variant->sims = implode(',', $request->sim[$key]);
                }
                $variant->label_name = $request->label_name[$key];
                $variant->save();
            }
        }

        if (isset($request->related_area)) {
            RelatedArea::where('product_id', $request->id)->delete();
            foreach ($request->related_area as $rArea) {
                $relatedArea = new RelatedArea();
                $relatedArea->area_id = $rArea;
                $relatedArea->product_id = $request->id;
                $relatedArea->save();
            }
        }

        if (isset($request->categories)) {
            insertProductCategories($request->categories, $product);
        }

        if (isset($request->searchCategories)) {
            insertProductSearchCategories($request->searchCategories, $product);
        }

        if (isset($request->areas)) {
            insertProductAreas($request->areas, $product);
        }

        if (isset($request->contexts)) {
            insertProductContexts($request->contexts, $product);
        }


        if (isset($request->tilbehor)) {
            insertProductTilbehor($request->tilbehor, $product);
        } else {
            $product->accessoriess()->delete();
        }

        if (isset($request->Mtilbehor)) {
            insertProductMtilbehor($request->Mtilbehor, $product);
        } else {
            $product->maccessoriess()->delete();
        }


        if (isset($request->passer)) {
            insertProductPasser($request->passer, $product);
        }


        if (isset($request->images) && sizeof($request->images) > 0) {
            $count = 0;

            foreach ($request->images as $key => $image) {

                $url = uploadFile($image, $request);
                if (preg_match('/(\.jpg|\.png|\.bmp|\.jpeg|\.gif|\.svg|\.svgz)$/', $url)) {
                    $type = 'image';
                } else {
                    $type = 'video';
                }
                $data[$count]['product_id'] = $product->id;
                $data[$count]['url'] = $url;
                $data[$count]['type'] = $type;
                $data[$count]['created_at'] = date('Y-m-d H:i:s');
                $data[$count]['updated_at'] = date('Y-m-d H:i:s');
                $count++;
            }

            $product->imagess()->createMany($data);

        }
//dd($request->altImages[0]);
        if (isset($request->productImages) && sizeof($request->productImages) > 0) {
            $count = 0;
            foreach ($request->productImages as $key => $image) {
                $explode = explode('.', $image);
                $type = end($explode);
                $data[$count]['product_id'] = $product->id;
                $data[$count]['url'] = $image;
                $data[$count]['type'] = $type;
                $data[$count]['alt_image'] = $request->altImages[$count];
                $data[$count]['title_image'] = $request->titleImages[$count];;
                $data[$count]['created_at'] = date('Y-m-d H:i:s');
                $data[$count]['updated_at'] = date('Y-m-d H:i:s');
                $count++;
            }
            $product->imagess()->createMany($data);

        }

        $success['redirect'] = "/admin/ecommerce-products-edit/$request->id";
        return $success;

    }
}

if (!function_exists('insertProductPasser')) {

    function insertProductPasser($passers, $product)
    {
        if (isset($passers) && sizeof($passers) > 0) {
            $count = 0;

            foreach ($passers as $key => $passer) {

                $data[$count]['product_id'] = $product->id;
                $data[$count]['relatedProduct'] = $passer;
                $data[$count]['created_at'] = date('Y-m-d H:i:s');
                $data[$count]['updated_at'] = date('Y-m-d H:i:s');
                $count++; //
            }

            // echo "<pre>"; print_r($data); echo "</pre>";   die;
            $product->passerss()->delete();
            $product->passerss()->createMany($data);
        }
    }
}

if (!function_exists('insertProductTilbehor')) {

    function insertProductTilbehor($tilbehors, $product)
    {
        if (isset($tilbehors) && sizeof($tilbehors) > 0) {
            $count = 0;

            foreach ($tilbehors as $key => $tilbehor) {

                $data[$count]['product_id'] = $product->id;
                $data[$count]['relatedProduct'] = $tilbehor;
                $data[$count]['created_at'] = date('Y-m-d H:i:s');
                $data[$count]['updated_at'] = date('Y-m-d H:i:s');
                $count++; //
            }
            // echo "<pre>"; print_r($data); echo "</pre>";   die;
            $product->accessoriess()->delete();
            $product->accessoriess()->createMany($data);
        }
    }
}
if (!function_exists('insertProductMtilbehor')) {

    function insertProductMtilbehor($Mtilbehors, $product)
    {
        if (isset($Mtilbehors) && sizeof($Mtilbehors) > 0) {
            $count = 0;

            foreach ($Mtilbehors as $key => $tilbehor) {

                $data[$count]['product_id'] = $product->id;
                $data[$count]['relatedProduct'] = $tilbehor;
                $data[$count]['created_at'] = date('Y-m-d H:i:s');
                $data[$count]['updated_at'] = date('Y-m-d H:i:s');
                $count++; //
            }
            // echo "<pre>"; print_r($data); echo "</pre>";   die;
            $product->maccessoriess()->delete();
            $product->maccessoriess()->createMany($data);
        }
    }
}

if (!function_exists('insertProductContexts')) {

    function insertProductContexts($cat, $product)
    {
        $categories = Context::whereIn('id', $cat)->get();

        $product->contexts()->detach();
        foreach ($categories as $key => $category) {
            $product->contexts()->attach($category);
        }
    }
}


if (!function_exists('insertProductAreas')) {

    function insertProductAreas($cat, $product)
    {
        $categories = Area::whereIn('id', $cat)->get();

        $product->areas()->detach();
        foreach ($categories as $key => $category) {
            $product->areas()->attach($category);
        }
    }
}


if (!function_exists('insertProductSearchCategories')) {

    function insertProductSearchCategories($cat, $product)
    {
        $categories = SearchCategory::whereIn('id', $cat)->get();

        $product->search_categories()->detach();
        foreach ($categories as $key => $category) {
            $product->search_categories()->attach($category);
        }
    }
}


if (!function_exists('insertProductCategories')) {

    function insertProductCategories($cat, $product)
    {
        $categories = Category::whereIn('id', $cat)->get();

        $product->categories()->detach();
        foreach ($categories as $key => $category) {
            $product->categories()->attach($category);
        }
    }
}

if (!function_exists('checkExtension')) {
    function checkExtension($file)
    {
        $supported_image = array('gif', 'jpg', 'jpeg', 'pdf', 'doc', 'DOCX', 'XLS', 'XLSX', 'csv', 'mp4', 'mov', 'mkv', 'png');

        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION)); // Using strtolower to overcome case sensitive
        if (in_array($ext, $supported_image)) {
            return 1;
        } else {
            return 0;
        }

    }
}


if (!function_exists('removeFile')) {

    function removeFile($url)
    {
        $message = "file does not exist.";
        if (file_exists($url)) {
            $message = "file deleted failed";
            if (checkExtension($url) == 1) {
                if (unlink($url)) {
                    $file = str_replace('public/', '', $url);
                    $file_new = str_replace('public/pagebuilder/uploads/', '', $url);
                    \DB::table('pagebuilder__uploads')->where('server_file', 'like', '%' . $file_new . '%')->delete();
                    \DB::table('product_images')->where('url', $file)->delete();
                    \DB::table('teams')->where('image', $file)->update(['image' => '']);
                    \DB::table('categories')->where('image', $file)->update(['image' => '']);
                    $message = "file deleted successfully";
                }
            } else {
                $message = "file deleted failed";
            }
        }

        return $message;
    }
}

if (!function_exists('updateUser')) {

    function updateUser($user, $request)
    {
        $success['success'] = 1;
        $success['message'] = "Profile Updated successfully.";
        $success['redirect'] = "/admin/profile";

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'pincode' => 'required',
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        if ($request->image != null && isset($request->image)) {
            $validator1 = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);


            if ($validator1->fails()) {
                $success['success'] = 3;
                $success['message'] = $validator1->errors()->first();

                return $success;
            }

            if (!empty($user->image) && $user->image != null) {

                $oldUrl = 'public/' . $user->image;
                $storage = storage_path('app/' . $user->image);
                removeFile($oldUrl);
                removeFile($storage);

            }
            $user->image = uploadFile($request->image);

        }

        $user->name = $request->name;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->pincode = $request->pincode;
        $user->mobile = $request->mobile;
        $user->save();

        return $success;
    }
}

if (!function_exists('userLogout')) {

    function userLogout()
    {
        $success['success'] = 1;
        $success['message'] = "Logout successfully.";
        $success['redirect'] = "/login-register";
        Session::flush();
        Auth::logout();
        \Cookie::forget('myCart');
        return $success;
    }
}

if (!function_exists('getAllUsersbyRole')) {

    function getAllUsersbyRole($role)
    {
        // $authorizedRoles = ['admin', 'sub_admin'];
        $authorizedRoles = [$role];
        $users = User::whereHas('roles', function ($q) use ($authorizedRoles) {
            $q->whereIn('slug', $authorizedRoles);
        })->paginate(20);
        return $users;
    }
}


if (!function_exists('imageCheck')) {

    function imageCheck($image)
    {
        return $image = ($image == null) ? "media/default.jpg" : $image;
    }
}

if (!function_exists('ForgetPasswordEmail')) {

    function ForgetPasswordEmail($request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        $success['success'] = 1;
        $success['message'] = "Reset password mail sent to your registered mail.";
        $success['redirect'] = "/login-register";

        if ($user == null) {

            $success['message'] = "User not find";
            $success['success'] = 3;
            return $success;

        }

        $token = getResetPassToken($user);

        $url = url("/reset-password/$token");
        $body = getResetBody($url);

        $details = [
            'body' => $body,
            'to' => $user->email,
            'subject' => 'Geoteam - Reset Your Password',
            'name' => $user->name,
        ];

        Mail::to($details['to'])->send(new \App\Mail\MyTestMail($details));

        return $success;
    }
}

if (!function_exists('getResetBody')) {
    function getResetBody($url)
    {
        $body = "<p style='font-family: Roboto, Arial, sans-serif;font-size: 14px;color: #767676; margin: 0;margin-bottom: 14px;line-height: 22px'>Please click <a href='" . $url . "' style='text-decoration: none;color: #03a9f4;'>here</a> to reset your password. If you did not reset account, no further action is required.</p>";

        return $body;
    }
}

if (!function_exists('getResetPassToken')) {

    function getResetPassToken($user)
    {

        $verifyData = array('token' => Str::random(40));
        $user->resetPass()->create($verifyData);
        return $verifyData['token'];

    }
}

if (!function_exists('getThirdPartyApi')) {

    function getThirdPartyApi($data)
    {

        $url = $data['url'];
        $accessToken = env('TOKEN');
        $curl = curl_init("$url");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: ' . 'Shop ' . $accessToken,
            'Content-Type: application/json',
            'Accept: application/json'
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $result = array();
        $result['json'] = json_decode($response);
        $result['response'] = $response;
        return $result;
    }
}

if (!function_exists('postThirdPartyApi')) {

    function postThirdPartyApi($data)
    {

        $url = $data['url'];
        $accessToken = env('TOKEN');

        $curl = curl_init("$url");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: ' . 'Shop ' . $accessToken,
            'Content-Type: application/json',
            'Accept: application/json'
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $result = array();
        $result['json'] = json_decode($response);
        $result['response'] = $response;
        return $result;
    }
}


if (!function_exists('getContent')) {

    function getContent($page)
    {

        $content = Content::where('page', $page)->get();
        if (sizeof($content) > 0) {

            $success['success'] = 1;
            $success['content'] = getContentArr($content, $page);
            $success['message'] = "";

        } else {
            $success['success'] = 0;
            $success['message'] = "Something went wromg.";
            $success['redirect'] = "/admin";
        }

        return $success;
    }
}

if (!function_exists('getContentArr')) {

    function getContentArr($contentObj, $page)
    {

        $contentArr = array();
        $contentArr['page'] = $page;

        foreach ($contentObj as $key => $data) {
            $contentArr[$data->name] = $data->data;
        }

        return $contentArr;
    }
}

if (!function_exists('getContent1')) {

    function getContent1($page)
    {

        $content = Content::where('page', $page)->get();
        if (sizeof($content) > 0) {

            $success['success'] = 1;
            $success['content'] = getContentArr1($content, $page);
            $success['message'] = "";

        } else {
            $success['success'] = 0;
            $success['message'] = "Something went wromg.";
            $success['redirect'] = "/admin";
        }

        return $success;
    }
}
if (!function_exists('footerData')) {

    function footerData()
    {
        return Footer::all();
    }
}

if (!function_exists('getHomeVideos')) {

    function getHomeVideos()
    {

        return Homevideo::all();
    }
}

if (!function_exists('getContentArr1')) {

    function getContentArr1($contentObj, $page)
    {

        $contentArr = array();
        $contentArr['page'][0] = $page;

        foreach ($contentObj as $key => $data) {

            $contentArr[$data->name][0] = $data->data;
            $contentArr[$data->name][1] = $data->type;
        }

        return $contentArr;
    }
}

if (!function_exists('contentUpdate')) {

    function contentUpdate($request)
    {

        $page = $request->page;
        $allContent = Content::where('page', $page)->get();

        $success['success'] = 0;
        $success['message'] = "Something went wromg.";
        $success['redirect'] = "/admin";


        if (sizeof($allContent) > 0) {

            foreach ($allContent as $key => $content) {
                $url = str_replace(request()->path(), "", url()->current());
                $request[$content->name] = str_replace("../../", $url, $request[$content->name]);
                if (isset($request[$content->name]) && $content->data != $request[$content->name]) {

                    $content->data = $request[$content->name];
                    $content->name = str_replace(' ', '', $content->name);
                    $content->updated_at = date('Y-m-d H:i:s');
                    $content->save();

                }
            }

            $success['success'] = 1;
            $success['message'] = ucwords(str_replace("_", " ", $page)) . " updated successfully.";
            $success['redirect'] = "/admin/editStatic/$page";
        }

        return $success;
    }
}

if (!function_exists('getAllStaticPages')) {

    function getAllStaticPages()
    {
        return Content::select('page')->distinct()->get();
    }
}

if (!function_exists('addContent')) {

    function addContent($data)
    {
        Content::create($data);
    }
}

if (!function_exists('getAllTeamMembers')) {

    function getAllTeamMembers()
    {
        $teams = Team::orderBy('rank', 'ASC')->paginate(2000);

        return $teams;
    }
}

if (!function_exists('getDataModel')) {

    function getDataModel($data)
    {
        $query = $data['modelName']::query();

        if (array_key_exists('where', $data)) {
            foreach ($data['where'] as $q) {
                $query->where($q['key'], $q['value']);
            }
        }

        if (array_key_exists('order_by', $data)) {
            $query->orderBy($data['order_by']['key'], $data['order_by']['value']);
        }

        if (array_key_exists('paginate', $data)) {
            $results = $query->paginate($data['paginate']);
        } elseif (array_key_exists('first', $data)) {
            $results = $query->first();
        } else {
            $results = $query->get();
        }

        return $results;
    }
}

if (!function_exists('insertTeam')) {
    function insertTeam($request)
    {
        $success['success'] = 1;
        $success['message'] = "Member added successfully.";
        $success['redirect'] = "/admin/addTeam";

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'rank' => 'required|max:255|unique:teams,rank',
            'email' => 'required|email',
            'business_area' => 'required'
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }


        $team = new Team();
        $team->name = $request->name;
        $team->rank = $request->rank;
        $team->email = $request->email;
        $team->business_area = $request->business_area;

        if ($request->designation != null && isset($request->designation)) {
            $team->designation = $request->designation;
        }

        if ($request->contact != null && isset($request->contact)) {
            $team->contact = $request->contact;
        }

        $url = "";
        if ($request->file('icon') != null) {
            $url = uploadFile($request->icon);
            $team->image = $url;
        }
        if (isset($request->productImages) && !empty($request->productImages[0])) {

            $team->alt_image = $request->altImages[0];
            $team->title_image = $request->titleImages[0];
            $team->image = $request->productImages[0];
        }

        $team->created_at = date('Y-m-d H:i:s');
        $team->updated_at = date('Y-m-d H:i:s');
        $team->save();

        return $success;
    }
}

if (!function_exists('getMemberDetail')) {
    function getMemberDetail($id)
    {

        $data = array();
        $data['id'] = $id;
        $data['modelName'] = 'App\Models\Team';

        $data['where'][0]['key'] = 'id';
        $data['where'][0]['value'] = $id;

        $data['first'] = 1;

        $result = getDataModel($data);
        if ($result != null) {

            $success['success'] = 1;
            $success['data'] = $result;
            $success['message'] = "";

        } else {
            $success['success'] = 0;
            $success['message'] = "Something went wromg.";
            $success['redirect'] = "/admin/addTeam";
        }

        return $success;
    }


}

if (!function_exists('updateTeamMember')) {
    function updateTeamMember($request)
    {
        $success['success'] = 1;
        $success['message'] = "Member updated successfully.";
        $success['redirect'] = "/admin/addTeam";

        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'id' => 'required|max:255|exists:teams,id',
            'name' => 'required|max:255',
            'rank' => "required|max:255|unique:teams,rank,$id",
            'email' => 'required|email',
            'business_area' => 'required',

        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $response = getMemberDetail($request->id);

        if ($response['success'] != 1) {
            return $response;
        }

        $team = $response['data'];

        if ($team->name != $request->name) {
            $team->name = $request->name;
        }

        if ($team->rank != $request->rank) {
            $team->rank = $request->rank;
        }

        if ($team->email != $request->email) {
            $team->email = $request->email;
        }

        if ($team->business_area != $request->business_area) {
            $team->business_area = $request->business_area;
        }

        if ($request->designation != null && isset($request->designation) && $team->designation != $request->designation) {
            $team->designation = $request->designation;
        }

        if ($request->contact != null && isset($request->contact) && $team->contact != $request->contact) {
            $team->contact = $request->contact;
        }

        $url = "";
        if ($request->file('icon') != null) {

            removeFile('public/' . $team->image);
            $storage = storage_path('app/' . $team->image);
            removeFile($storage);
            $url = uploadFile($request->icon);
            $team->image = $url;
        }

        if (isset($request->productImages) && !empty($request->productImages[0])) {
            $team->alt_image = $request->altImages[0];
            $team->title_image = $request->titleImages[0];
            $team->image = $request->productImages[0];
        }

        $team->updated_at = date('Y-m-d H:i:s');
        $team->save();

        return $success;
    }
}

if (!function_exists('insertProductCategory')) {
    function insertProductCategory($product, $category)
    {

        // $product = Product::where('id', 1)->first();
        // $category = Category::where('id', 3)->first();
        $product->categories()->attach($category);

    }
}

if (!function_exists('getAllSearchCategories')) {
    function getAllSearchCategories()
    {
        $categories = SearchCategory::paginate(100);
        return $categories;
    }
}

if (!function_exists('insertSearchCategories')) {
    function insertSearchCategories($request)
    {
        $success['success'] = 1;
        $success['message'] = "Category added successfully.";
        $success['redirect'] = "/admin/ecommerce-search-categories";

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:search_categories,name'
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        // $url = "";
        // if ($request->file('icon') != null) {
        //     $url    = uploadFile($request->icon);
        // }

        $category = new SearchCategory();
        $category->name = $request->name;
        // $category->image        = $url;
        $category->created_at = date('Y-m-d H:i:s');
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        return $success;
    }
}

if (!function_exists('getAllAreas')) {
    function getAllAreas()
    {
        $areas = Area::orderBy('rank', 'ASC')->paginate(20);
        return $areas;
    }
}

if (!function_exists('insertArea')) {
    function insertArea($request)
    {
        $success['success'] = 1;
        $success['message'] = "Area added successfully.";
        $success['redirect'] = "/admin/ecommerce-areas";

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:areas,name',
            'rank' => 'required|max:255|unique:areas,rank',
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        // $url = "";
        // if ($request->file('icon') != null) {
        //     $url    = uploadFile($request->icon);
        // }

        $category = new Area();
        $category->name = $request->name;
        $category->rank = $request->rank;
        $category->description = $request->description;
        // $category->image        = $url;
        $category->created_at = date('Y-m-d H:i:s');
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        return $success;
    }
}

if (!function_exists('updateArea')) {
    function updateArea($request)
    {
        $success['success'] = 1;
        $success['message'] = "Area updated successfully.";
        $success['redirect'] = "/admin/ecommerce-areas";
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'id' => 'required|max:255|exists:areas,id',
            'name' => "required|max:255|unique:areas,name,$id",
            'rank' => "required|max:255|unique:areas,rank,$id",
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $category = Area::find($request->id);
        $category->name = $request->name;
        $category->rank = $request->rank;
        $category->description = $request->description;

        // if ($request->file('icon') != null) {
        //     $category->image        = uploadFile($request->icon);
        // }
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        return $success;
    }
}

if (!function_exists('getAllContext')) {
    function getAllContext()
    {
        $context = Context::paginate(20);
        return $context;
    }
}

if (!function_exists('getAllContextWithoutPage')) {
    function getAllContextWithoutPage()
    {
        return $context = Context::get();
    }
}

if (!function_exists('insertContext')) {
    function insertContext($request)
    {
        $success['success'] = 1;
        $success['message'] = "Context added successfully.";
        $success['redirect'] = "/admin/ecommerce-content";

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:contexts,name',
            'type' => 'required',
            'parent_id' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

//        if (($request->type == 'guide' || $request->type == 'video' || $request->type == 'file') && $request->file('icon') == null) {
//            $success['success'] = 3;
//            $success['message'] = "File required.";
//            return $success;
//        }

        $url = "";
        if ($request->file('icon') != null) {
            $url = uploadFile($request->icon);
        }

        $category = new Context();
        $category->name = $request->name;
        $category->type = $request->type;
        $category->file_url = $url;
        $category->description = $request->description;
        $category->pageId = $request->page_id;
        if (isset($request->link) && $request->link != '') {
            $category->link = $request->link;
        }
        if (isset($request->productImages) && !empty($request->productImages[0])) {

            $category->alt_image = $request->altImages[0];
            $category->title_image = $request->titleImages[0];
            $category->file_url = $request->productImages[0];
        }

        if ($request->parent_id != 0) {
            $category->parent_id = $request->parent_id;
        }

        $category->created_at = date('Y-m-d H:i:s');
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        if (isset($request->categories)) {
            insertProductCategories($request->categories, $category);
        }

        if (isset($request->searchCategories)) {
            insertProductSearchCategories($request->searchCategories, $category);
        }

        if (isset($request->areas)) {
            insertProductAreas($request->areas, $category);
        }
        return $success;
    }
}

if (!function_exists('updateContext')) {
    function updateContext($request)
    {
        $success['success'] = 1;
        $success['message'] = "Content updated successfully.";
        $success['redirect'] = "/admin/ecommerce-content";

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
            'parent_id' => 'required'
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $category = Context::find($request->id);

//        if (($category->type == 'guide' || $category->type == 'video' || $category->type == 'file') && $request->file('icon') != null) {
//            $oldUrl = 'public/' . $category->file_url;
//            $storage = storage_path('app/'. $category->file_url);
//            removeFile($oldUrl);
//            removeFile($storage);
//        }

        $category->name = $request->name;
        $category->type = $request->type;
        $category->pageId = $request->page_id;
        $category->description = $request->description;
        if (isset($request->link) && $request->link != '') {
            $category->link = $request->link;
        }

        $url = "";
        if ($request->file('icon') != null) {
            $url = uploadFile($request->icon);
            $category->file_url = $url;
        }
        if (isset($request->productImages) && !empty($request->productImages[0])) {

            $category->alt_image = $request->altImages[0];
            $category->title_image = $request->titleImages[0];
            $category->file_url = $request->productImages[0];
        }

        $category->created_at = date('Y-m-d H:i:s');
        $category->updated_at = date('Y-m-d H:i:s');


        if ($request->parent_id != 0) {
            $category->parent_id = $request->parent_id;
        } else {
            $category->parent_id = null;
        }

        $category->save();

        if (isset($request->categories)) {
            insertProductCategories($request->categories, $category);
        }

        if (isset($request->searchCategories)) {
            insertProductSearchCategories($request->searchCategories, $category);
        }

        if (isset($request->areas)) {
            insertProductAreas($request->areas, $category);
        }
        return $success;
    }
}


if (!function_exists('inserUpdateProduct')) {
    function inserUpdateProduct($json)
    {
        $tempProducts = [];
        if (!empty($json) && sizeof($json) > 0) {
            foreach ($json as $key => $pro) {
                $product = Product::where('api_id', $pro->productnumber)->first();
                if ($product == null) {
                    $product = new Product();
                    $product->api_id = "$pro->productnumber";
                    $product->status = '0';
                }

                $product->api_name = "$pro->productname";
                $product->type = $pro->productType;
                $product->save();

                $data[] = $pro->productnumber;
            }
            echo "<pre>";
            $allProducts = Product::all();
            foreach ($allProducts as $key => $product) {
                //echo $product->api_id."<br>";
                if ($product->is_subscription != '1') {
                    if (in_array($product->api_id, $data)) {
                        // echo $product->api_id."<br>";
                        \DB::table('products')->where('api_id', $product->api_id)->update(['delete_status' => 0]);
                    } else {
                        // echo $product->api_id."- failed  <br>";
                        \DB::table('products')->where('api_id', $product->api_id)->update(['delete_status' => 1]);
                    }
                }
            }


        }
    }
}


if (!function_exists('inserUpdateOrganisation')) {
    function inserUpdateOrganisation($json)
    {
        $data = array();
        $count = 0;
        if (!empty($json) && sizeof($json) > 0) {
            foreach ($json as $key => $org) {
                $organisation = Gpsnetorganization::where('api_organisation_id', $org->organizationId)->first();
                if ($organisation == null) {

                    $data[$count]['api_organisation_id'] = $org->organizationId;
                    $data[$count]['api_short_name'] = $org->shortName;
                    $data[$count]['api_long_name'] = $org->longName;
                    $data[$count]['api_description'] = $org->description;

                    $count++;
                }
            }
        }

        if (sizeof($data) > 0) {
            Gpsnetorganization::insert($data);
        }

    }
}

if (!function_exists('removeProductImage')) {
    function removeProductImage($request)
    {

        $success['success'] = 1;
        $success['message'] = "Image deleted successfully.";

        $validator = Validator::make($request->all(), [
            'id' => 'required|max:255|exists:product_images,id'
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }
        $image = ProductImage::find($request->id);
        $image->delete();
        return $success;
    }
}

if (!function_exists('deleteAllProductImg')) {
    function deleteAllProductImg($id)
    {

        $success['success'] = 1;
        $success['message'] = "Image deleted successfully.";

        ProductImage::where('product_id', $id)->delete();
        return $success;
    }
}


if (!function_exists('duplicatePage')) {
    function duplicatePage($id)
    {
        $page = DB::table('pagebuilder__pages')->where('id', $id)->first();
        $trans = DB::table('pagebuilder__page_translations')->where('page_id', $id)->first();

        $copyId = DB::table('pagebuilder__pages')->insertGetId(
            array('name' => $page->name . '-copy', 'layout' => 'master', 'data' => $page->data)
        );

        DB::table('pagebuilder__page_translations')->insertGetId(
            array('page_id' => $copyId, 'locale' => 'en', 'title' => $trans->title . '-copy', 'route' => $trans->route . '_copy')
        );

        return true;
    }
}

if (!function_exists('getAllProductCategories_new')) {
    function getAllProductCategories_new($data)
    {
        $productApiName = array();
        $products = array();
        $category = Category::where('name', $data['categoryId'])->first();

        if (isset($data['areaId'])) {

            foreach ($category->products->where('status', '1') as $key => $product) {

                if ($product->areas != null && sizeof($product->areas) > 0) {

                    foreach ($product->areas as $key => $area) {

                        if ($area->name == $data['areaId']) {
                            $products[$product->id] = $product;
                            $productApiName[$product->id] = $product->api_name;
                        }
                    }
                }
            }
        } else {

            $products = $category->products->where('status', '1');
            foreach ($products as $product) {
                $productApiName[$product->id] = $product->api_name;
            }
        }

        $result = array('productApiName' => $productApiName, 'products' => $products);
        return $result;
    }
}

if (!function_exists('getAllProductCategories')) {
    function getAllProductCategories($data)
    {
        $productApiName = array();
        $products = array();
        $category = Category::where('id', $data['categoryId'])->first();
        if (isset($data['areaId'])) {

            foreach ($category->products->where('status', '1') as $key => $product) {

                if ($product->areas != null && sizeof($product->areas) > 0) {

                    foreach ($product->areas as $key => $area) {

                        if ($area->id == $data['areaId']) {
                            $products[$product->id] = $product;
                            $productApiName[$product->id] = $product->api_name;
                        }
                    }
                }
            }
        } else {

            $products = $category->products->where('status', '1');
            foreach ($products as $product) {
                $productApiName[$product->id] = $product->api_name;
            }
        }

        $result = array('productApiName' => $productApiName, 'products' => $products);
        return $result;
    }
}

if (!function_exists('getProductAPpiObj')) {
    function getProductAPpiObj($products, $customerNo = null, $qty = null)
    {

        $customerDetails = getProductPrice();
        if (isset($customerDetails[1])) {
            $customerNo = $customerDetails[1]->CustomerNo;
        }

        $count = 0;
        $dataObj = array();
        $dataObj['customerNumber'] = (string)$customerNo;
        $dataObj['productList'] = array();
        if ($qty == 1) {
            foreach ($products as $product) {
                //echo "<pre>"; print_r($product); die;
                $dataObj['productList'][$count] = new \stdClass;
                $dataObj['productList'][$count]->productNumber = $product['api_id'];
                $dataObj['productList'][$count]->requestedQuantity = $product['qty'];
                $count++;

            }
        } else {
            foreach ($products as $product) {
                $dataObj['productList'][$count] = new \stdClass;
                $dataObj['productList'][$count]->productNumber = $product->api_id;
                $dataObj['productList'][$count]->requestedQuantity = 1;
                $count++;
            }
        }

        //echo "<pre>"; print_r($dataObj); die;
        $response = postApi('Product/Prices', $dataObj);
        return $response;
        //dd($response);
        if (is_array($response)) {
            return $response;
        } else {
            return json_decode($response);
        }

//        echo "<pre>"; print_r($response); die;

    }
}

if (!function_exists('getProductAPpiArr')) {
    function getProductAPpiArr($products, $customerNo = null, $qty = null)
    {

        $customerDetails = getProductPrice();
        if (isset($customerDetails[1])) {
            $customerNo = $customerDetails[1]->CustomerNo;
        }


        $count = 0;
        $dataObj = array();
        $dataObj['customerNumber'] = (string)$customerNo;
        $dataObj['productList'] = array();
        foreach ($products as $key => $product) {

//                echo "<pre>"; print_r($product); die;
            $dataObj['productList'][$count] = new \stdClass;
            $dataObj['productList'][$count]->productNumber = $products[$key]['api_id'];
            if ($qty == null) {
                $dataObj['productList'][$count]->requestedQuantity = 1;
            } else {
                $dataObj['productList'][$count]->requestedQuantity = $products[$key]['quantity'];
            }

            $count++;

        }

        $response = postApi('Product/Prices', $dataObj);
        return $response;
        //dd($response);
        if (is_array($response)) {
            return $response;
        } else {
            return json_decode($response);
        }

//        echo "<pre>"; print_r($response); die;

    }
}

if (!function_exists('insertProdukter')) {
    function insertProdukter($request)
    {
        $success['success'] = 1;
        $success['message'] = "Produkter added successfully.";
        $success['redirect'] = "/admin/ecommerce-produkters-list";

        $validator = Validator::make($request->all(), [
            'name' => "required|max:255|unique:produkters,name",
            'rank' => 'required|max:255|unique:produkters,rank',
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $category = new Produkter();
        $category->name = $request->name;
        $category->rank = $request->rank;
        $category->url = $request->url;
        $category->created_at = date('Y-m-d H:i:s');
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        insertProdukterAreas($request->areas, $category);
        return $success;
    }
}

if (!function_exists('insertProdukterAreas')) {

    function insertProdukterAreas($cat, $product)
    {
        $categories = Area::whereIn('id', $cat)->get();

        $product->areas()->detach();
        foreach ($categories as $key => $category) {
            $product->areas()->attach($category);
        }
    }
}

if (!function_exists('updateProdukter')) {
    function updateProdukter($request)
    {
        $success['success'] = 1;
        $success['message'] = "Produkter updated successfully.";
        $success['redirect'] = "/admin/ecommerce-produkters-list";

        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'id' => 'required|max:255|exists:produkters,id',
            'name' => "required|max:255|unique:produkters,name,$id",
            'rank' => "required|max:255|unique:produkters,rank,$id",
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $category = Produkter::find($request->id);
        $category->name = $request->name;
        $category->rank = $request->rank;
        $category->url = $request->url;
        $category->created_at = date('Y-m-d H:i:s');
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        insertProdukterAreas($request->areas, $category);
        return $success;
    }
}

if (!function_exists('updateFaq')) {
    function updateFaq($request)
    {
        $success['success'] = 1;
        $success['message'] = "FAQ updated successfully.";
        $success['redirect'] = "/admin/faqs";

        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:faqs,id',
            'question' => "required",
            'answer' => 'required',
            'areas.*' => 'required|exists:areas,id',
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $category = Faq::find($request->id);
        $category->question = $request->question;
        $category->answer = $request->answer;
        $category->created_at = date('Y-m-d H:i:s');
        $category->updated_at = date('Y-m-d H:i:s');

        if ($request->status != null && isset($request->status)) {
            $category->status = "$request->status";
        } else {
            $category->status = "0";
        }

        $category->save();

        insertFaqAreas($request->areas, $category);

        return $success;
    }
}

if (!function_exists('getAllSubProdukters')) {
    function getAllSubProdukters()
    {
        $produkter = SubProdukter::paginate(20);
        return $produkter;
    }
}

if (!function_exists('insertSubProdukter')) {
    function insertSubProdukter($request)
    {
        $success['success'] = 1;
        $success['message'] = "Sub-produkter added successfully.";
        $success['redirect'] = "/admin/ecommerce-produkters-list";

        $validator = Validator::make($request->all(), [
            'produkterId' => "required|max:255|exists:produkters,id",
            'name' => "required|max:255",
            'link' => "required"
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $category = new SubProdukter();
        $category->name = $request->name;
        $category->url = $request->link;
        $category->produkter_id = $request->produkterId;
        $category->created_at = date('Y-m-d H:i:s');
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        return $success;
    }
}

if (!function_exists('updateSubProdukter')) {
    function updateSubProdukter($request)
    {
        $success['success'] = 1;
        $success['message'] = "Sub-produkter added successfully.";
        $success['redirect'] = "/admin/ecommerce-produkters-list";

        $validator = Validator::make($request->all(), [
            'id' => "required|max:255|exists:sub_produkters,id",
            'name' => "required|max:255",
            'link' => "required"
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $category = SubProdukter::where('id', $request->id)->first();
        $category->name = $request->name;
        $category->url = $request->link;

        $category->created_at = date('Y-m-d H:i:s');
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();
        $success['redirect'] = "/admin/ecommerce-sub-produkters/$category->produkter_id";
        return $success;
    }
}

if (!function_exists('searchProduct')) {
    function searchProduct($request, $ajaxRequest, $requestContext)
    {
        $sort = $ajaxRequest->sort;
        $name = $ajaxRequest->name;

        $sql = "select products.*, product_images.url,product_images.title_image,product_images.alt_image, sc.name, areas.id as areaID, categories.id as categoryId
                from products left JOIN products_categories as pc on pc.product_id = products.id LEFT JOIN categories on categories.id = pc.category_id left JOIN
                products_areas as pa ON pa.product_id = products.id LEFT JOIN areas on areas.id = pa.area_id LEFT JOIN products_searchcategories as psc ON
                psc.product_id = products.id LEFT JOIN search_categories as sc ON sc.id = psc.search_category_id LEFT JOIN product_images ON
                product_images.product_id = products.id WHERE ";
        $querySuccess = 0;

        $str1 = '';
        if (isset($name) && !empty($name) && $name != '') {
            $sql .= "(products.api_id LIKE '%$name%' OR products.api_name LIKE '%$name%' OR sc.name LIKE '%$name%' OR contexts.name LIKE '%$name%') ";
            $str1 .= "(products.api_id LIKE '%$name%' OR products.api_name LIKE '%$name%' OR sc.name LIKE '%$name%' OR contexts.name LIKE '%$name%') ";
            if (sizeof($request) > 0) {

                $sql .= "AND (";
                $str1 .= "AND (";
                $countFlag = 1;

                foreach ($request as $key => $value) {
                    $authorizedAreas = $key;
                    $authorizedCategories = rtrim(implode(",", $value), ',');

                    if ($countFlag == 1) {
                        $sql .= " (areas.id = $key AND (categories.id IN ($authorizedCategories))) ";
                        $str1 .= " (areas.id = $key AND (categories.id IN ($authorizedCategories))) ";

                    } else {
                        $sql .= " OR  (areas.id = $key AND (categories.id IN ($authorizedCategories)))";
                        $str1 .= " OR  (areas.id = $key AND (categories.id IN ($authorizedCategories)))";
                    }


                    $countFlag++;
                }
                $sql .= ")";
                $str1 .= ")";
            }

            if (sizeof($requestContext) > 0) {

                $sql .= "AND (";
                $str1 .= "AND (";
                $countFlag = 1;

                foreach ($requestContext as $key => $value) {

                    if ($countFlag == 1) {

                        $sql .= " (contexts.type = '$value') ";
                        $str1 .= " (contexts.type = '$value') ";


                    } else {

                        $sql .= " OR (contexts.type = '$value') ";
                        $str1 .= " OR (contexts.type = '$value') ";

                    }

                    $countFlag++;
                }
                $sql .= ")";
                $str1 .= ")";
            }

            if ($sort == 2) {
                $sql .= " AND products.status ='1'  GROUP BY products.id ORDER BY products.api_name ASC";
                $str1 .= " AND products.status ='1'  GROUP BY products.id ORDER BY products.api_name ASC";
            } elseif ($sort == 3) {
                $sql .= " AND products.status ='1'  GROUP BY products.id ORDER BY products.api_id ASC";
                $str1 .= " AND products.status ='1'  GROUP BY products.id ORDER BY products.api_id ASC";
            } else {
                $sql .= " AND products.status ='1'  GROUP BY products.id ORDER BY products.api_name ASC";
                $str1 .= " AND products.status ='1'  GROUP BY products.id ORDER BY products.api_name ASC";
            }

            $querySuccess = 1;

        } elseif (sizeof($request) > 0) {
            $sql .= "(";
            $str1 .= "(";
            $countFlag = 1;
            foreach ($request as $key => $value) {
                $authorizedAreas = $key;
                $authorizedCategories = rtrim(implode(",", $value), ',');

                if ($countFlag == 1) {
                    $sql .= " (areas.id = $key AND (categories.id IN ($authorizedCategories))) ";
                    $str1 .= " (areas.id = $key AND (categories.id IN ($authorizedCategories))) ";
                } else {
                    $sql .= " OR  (areas.id = $key AND (categories.id IN ($authorizedCategories)))";
                    $str1 .= " OR  (areas.id = $key AND (categories.id IN ($authorizedCategories)))";
                }


                $countFlag++;
            }

            if (sizeof($requestContext) > 0) {

                $sql .= "AND (";
                $str1 .= "AND (";
                $countFlag = 1;

                foreach ($requestContext as $key => $value) {

                    if ($countFlag == 1) {

                        $sql .= " (contexts.type = '$value') ";
                        $str1 .= " (contexts.type = '$value') ";


                    } else {

                        $sql .= " OR (contexts.type = '$value') ";
                        $str1 .= " OR (contexts.type = '$value') ";

                    }

                    $countFlag++;
                }
                $sql .= ")";
                $str1 .= ")";
            }

            $sql .= ")";
            $str1 .= ")";

            if ($sort == 2) {
                $sql .= " AND products.status ='1'  GROUP BY products.id ORDER BY products.api_name ASC";
                $str1 .= " AND products.status ='1'  GROUP BY products.id ORDER BY products.api_name ASC";
            } elseif ($sort == 3) {
                $sql .= " AND products.status ='1'  GROUP BY products.id ORDER BY products.api_id ASC";
                $str1 .= " AND products.status ='1'  GROUP BY products.id ORDER BY products.api_id ASC";
            } else {
                $sql .= " AND products.status ='1'  GROUP BY products.id ORDER BY products.api_name ASC";
                $str1 .= " AND products.status ='1'  GROUP BY products.id ORDER BY products.api_name ASC";
            }
            $querySuccess = 1;
        }


        //
        $products = DB::table('products');
        $products->leftjoin('products_contexts as pcont', 'pcont.product_id', '=', 'products.id');
        $products->leftjoin('contexts', 'contexts.id', '=', 'pcont.context_id');

        $products->leftjoin('products_categories as pc', 'pc.product_id', '=', 'products.id');
        $products->leftjoin('categories', 'categories.id', '=', 'pc.category_id');
        $products->leftjoin('products_areas as pa', 'pa.product_id', '=', 'products.id');
        $products->leftjoin('areas', 'areas.id', '=', 'pa.area_id');
        $products->leftjoin('products_searchcategories as psc', 'psc.product_id', '=', 'products.id');
        $products->leftjoin('search_categories as sc', 'sc.id', '=', 'psc.search_category_id');
        $products->leftjoin('product_images', 'product_images.product_id', '=', 'products.id');

        if ($querySuccess == 1) {

            $products->whereRaw($str1);
            // $result = DB::select(DB::raw($sql));

        } else {
            if (isset($sort) && $sort != 1) {
                if ($sort == 2) {
                    $str1 = " products.status ='1' GROUP BY products.id ORDER BY products.api_name ASC";
                } elseif ($sort == 3) {
                    $str1 = " products.status ='1' GROUP BY products.id ORDER BY products.api_id ASC";
                }
            } else {
                $str1 = " products.status ='1'  GROUP BY products.id ORDER BY products.api_name ASC";
            }

            $products->whereRaw($str1);
        }

        $products->select("products.*", "product_images.url", "product_images.title_image", "product_images.alt_image", "contexts.name as contextName", "contexts.type as contextType", "contexts.link as contextLink", "contexts.file_url as contextFile");
        $totalCount = $products->get()->count();
        $products = $products->simplePaginate(1000);

        $success['success'] = 1;
        $success['products'] = $products;
        $success['totalProducts'] = $totalCount;
        $success['$request'] = $request;
        $success['links'] = $products->links()->render();

        return $success;


    }
}


if (!function_exists('searchProduct1')) {
    function searchProduct1($request, $ajaxRequest)
    {
        $sort = $ajaxRequest->sort;
        $name = $ajaxRequest->name;

        $products = Product::with('imagess');
        if (isset($name) && !empty($name) && $name != '') {
            $products->where('api_name', 'like', '%' . $name . '%');
            $products->orWhere('api_id', 'like', '%' . $name . '%');
            $products->orWhereHas('search_categories', function ($query) use ($name) {
                $query->where('name', $name);
            });
        }

        if (sizeof($request) > 0) {

            $first = array_key_first($request);
            foreach ($request as $key => $value) {
                $authorizedAreas = $key;
                $authorizedCategories = $value;
                if ($key == $first) {
                    $products->whereHas('categories', function ($query) use ($authorizedCategories) {
                        $query->whereIn('id', $authorizedCategories);
                    });

                    $products->whereHas('areas', function ($query) use ($authorizedAreas) {
                        $query->where('id', $authorizedAreas);
                    });
                } else {
                    $products->orWhereHas('categories', function ($query) use ($authorizedCategories) {
                        $query->whereIn('id', $authorizedCategories);
                    });
                    $products->whereHas('areas', function ($query) use ($authorizedAreas) {
                        $query->where('id', $authorizedAreas);
                    });
                }
            }

        }
        $products->where('status', '1');
        if (isset($sort) && $sort != 1) {
            if ($sort == 2) {
                $products->orderBy('products.api_name', 'ASC');
            } elseif ($sort == 3) {
                $products->orderBy('products.api_id', 'ASC');
            }
        }
        if (isset($ajaxRequest->headerSearchToken) && $ajaxRequest->headerSearchToken == 1) {
            $products = $products->paginate(4);
        } else {
            $products = $products->paginate(10);
            // $products = $products->get();
        }
        $success['success'] = 1;
        $success['products'] = $products;
        $success['totalProducts'] = count($products);
        $success['$request'] = $request;
        $success['links'] = $products->links()->render();

        return $success;
    }
}

if (!function_exists('searchContentParam')) {
    function searchContentParam($key, $type, $requestContext, $contextAreaIds)
    {
        $contents = Context::where('name', 'LIKE', '%' . $key . '%');
        $totalAreaCount = Area::get()->count();

        if (sizeof($requestContext) > 0) {
            $contents->whereIn('type', $requestContext);
        } else {
            if ($type == 'file') {
                $contents->where(function ($query) {
                    $query->where('type', 'manual')
                        ->orWhere('type', 'guide')
                        ->orWhere('type', 'file')
                        ->orWhere('type', 'video');
                });
            } else {
                $contents->where(function ($query) {
                    $query->where('type', 'link')
                        ->orWhere('type', 'page');
                });
            }
        }

        if (sizeof($contextAreaIds) > 0 && sizeof($contextAreaIds) < $totalAreaCount) {

            $authorizedAreas = $contextAreaIds;

            $contents->whereHas('areas', function ($query) use ($authorizedAreas) {
                $query->whereIn('areas.id', $authorizedAreas);
            });
        }
        // $contents = $contents->toSql();
        $totalCount = $contents->get()->count();
        $contents = $contents->simplePaginate(20);

        $result = array();
        $result['totalCount'] = $totalCount;
        $result['contents'] = $contents;
        return $result;
    }
}

if (!function_exists('searchContent')) {
    function searchContent($type, $contextAreaIds)
    {
        $totalAreaCount = Area::get()->count();
        if ($type == 'file') {
            $contents = Context::where(function ($query) {
                $query->where('type', 'manual')
                    ->orWhere('type', 'guide')
                    ->orWhere('type', 'file')
                    ->orWhere('type', 'video');
            });
        } else {
            $contents = Context::where(function ($query) {
                $query->where('type', 'link')
                    ->orWhere('type', 'page');
            });
        }

        if (sizeof($contextAreaIds) > 0 && sizeof($contextAreaIds) < $totalAreaCount) {
            $authorizedAreas = $contextAreaIds;

            $contents->whereHas('areas', function ($query) use ($authorizedAreas) {
                $query->whereIn('areas.id', $authorizedAreas);
            });
        }

        $totalCount = $contents->get()->count();
        $contents = $contents->simplePaginate(100);

        $result = array();
        $result['totalCount'] = $totalCount;
        $result['contents'] = $contents;

        return $result;
    }
}

function customSearchContent($type, $contextAreaIds)
{

}


function getCustomContentCount()
{
    return $products = \DB::table('products_contexts')->leftJoin('products', 'products.id', '=', 'products_contexts.product_id')->where('products.status', '1')->groupBy('products_contexts.product_id')->pluck('products_contexts.product_id');

}

function areaContent($areaId)
{
    $arr = [];
    foreach (getCustomContentCount() as $ar) {
        $arr[] = $ar;
    }
    return $products = \DB::table('products_areas')->select('products_areas.product_id')->whereIn('products_areas.product_id', $arr)->where('products_areas.area_id', $areaId)->get();

}


if (!function_exists('getContentCount')) {
    function getContentCount($request)
    {
        $contentTpes = getContentTypes();
        $result = array();

        if (isset($request->name)) {
            $result['total'] = Context::where('name', 'like', '%' . $request->name . '%')->get()->count();
        } else {
            $result['total'] = Context::get()->count();
        }

        foreach ($contentTpes as $type) {

            $context = Context::where('type', $type);

            if (isset($request->name)) {
                $context->where('name', 'like', '%' . $request->name . '%');
            }

            $result[$type] = $context->get()->count();
        }
        return $result;
    }
}

if (!function_exists('getContentTypes')) {
    function getContentTypes()
    {
        return array('manual', 'guide', 'video', 'page', 'link', 'file');
    }
}

if (!function_exists('updataCart')) {
    function updataCart($productId, $qty)
    {
//        echo "<pre>"; print_r( $productId); echo "</pre>";
//        echo "<pre>"; print_r( $qty); echo "</pre>";

        $cart = (array)(getCookie('cart'));

        if (!empty($cart) && isset($cart[$productId])) {

            if ($qty <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]->qty = $qty;
            }
        } else {

            if ($qty > 0) {

                $cart[$productId] = new \stdClass;
                $cart[$productId]->qty = $qty;
                $cart[$productId]->productId = $productId;

            }
        }

        addCookie('cart', json_encode($cart));
        $temp = [];
        // echo "<pre>";
        foreach ($cart as $values) {
            $arr['api_id'] = $values->productId;
            $arr['qty'] = $values->qty;
            array_push($temp, $arr);
        }
        return $cart = (array)(getCookie('cart'));
        return $productApiPrices = getProductAPpiObj($temp, $customerNo = null, $qty = 1);

    }
}

if (!function_exists('deleteCookie')) {
    function deleteCookie($cookie)
    {
        return Cookie::queue(Cookie::forget($cookie));
    }
}

if (!function_exists('addCookie')) {
    function addCookie($key, $value)
    {
//        dd($key);
        return Cookie::queue($key, $value, 10000);
    }
}

if (!function_exists('getCookie')) {
    function getCookie($key)
    {
        return json_decode(Cookie::get($key));
    }
}

if (!function_exists('shareCart')) {
    function shareCart()
    {
        $result = array();
        $url = str_replace(request()->path(), "", url()->current());

        $shareCart = new ShareCart();
        $shareCart->data = Cookie::get('cart');
        $shareCart->token = Str::random(30);
        $shareCart->created_at = date('Y-m-d H:i:s');
        $shareCart->updated_at = date('Y-m-d H:i:s');
        $shareCart->save();

        $result['url'] = $url . "share-cart/$shareCart->token";
        return $result;
    }
}


if (!function_exists('updateShareCartCookie')) {
    function updateShareCartCookie($token)
    {
        $shareCart = ShareCart::where('token', $token)->first();

        if ($shareCart == null) {

            $success['message'] = "Cart not find";
            $success['success'] = 3;
            $success['redirect'] = "/home";
            return $success;

        }


        $carts = (array)json_decode($shareCart->data);
        if (sizeof($carts) == 0) {

            $success['message'] = "Cart not find";
            $success['success'] = 3;
            $success['redirect'] = "/home";
            return $success;

        }

        deleteCookie('cart');
        addCookie('cart', $shareCart->data);

        $success['message'] = "Cart shared successfully find";
        $success['success'] = 3;
        $success['redirect'] = "/cart";
        $success['cart'] = $carts;
        return $success;

    }
}


if (!function_exists('cartList')) {
    function cartList()
    {
        $temp = [];
        $cartList = getCookie('cart');
        //dd($cartList);
        if (sizeof((array)$cartList) > 0) {
            foreach ($cartList as $cart) {
                $apiId['api_id'] = $cart->productId;
                $apiId['qty'] = $cart->qty;
                array_push($temp, $apiId);
            }
            $data['carts'] = [];
            if (isset($apiId)) {
                $data['carts'] = getProductDetailsWithParam($temp);
            }
        } else {
            $data['carts'] = [];
        }
        $data['cartDetails'] = $cartList;
        return $data;
    }
}

if (!function_exists('updateSupportData')) {
    function updateSupportData($request)
    {
        $success['success'] = 1;
        $success['message'] = "Service/Support updated successfully.";
        $success['redirect'] = "/admin/edit-support";

        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            $success['success'] = 3;
            $success['message'] = $validator->errors()->first();
            return $success;
        }

        $category = Service::find($request->id);
        $category->data = $request->description;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        if (isset($request->contexts)) {
            insertProductContexts($request->contexts, $category);
        }

        return $success;
    }
}

if (!function_exists('createPriceData')) {
    function createPriceData($priceArr)
    {
        $result = array();

        if (sizeof($priceArr) > 0) {
            foreach ($priceArr as $key => $data) {
                $result[$data->productNumber] = $data;
            }
        }

        return $result;
    }
}

if (!function_exists('sendMail')) {
    function sendMail($name, $email, $phone, $message, $subject)
    {
        $input_arr = array(
            'name' => $name,
            'email' => $email,
            'contactNo' => $phone,
            'message' => "Testing Message",
            'subject' => $subject,
        );
        $input_arr['msg'] = $message;
        $result = Mail::send('email.contact', $input_arr, function ($message) use ($input_arr) {
            $message->to($input_arr['email'], 'Contact US')
                ->subject($input_arr['subject']);
            $message->from('no-reply@geoteam', 'Cart Details');
        });
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    if (!function_exists('getRootParent')) {
        function getRootParent($areaId)
        {
            return StaticContent::select('context_id')->where('area_id', $areaId)->groupBy('context_id')->get()->toArray();
        }
    }

    if (!function_exists('getParent')) {
        function getParent($array)
        {

            if ($array) {
                $data = [];
                $temp_data = '';
                foreach ($array as $val) {
                    $temp_data .= "'" . $val['context_id'] . "',";
                }
                $temp_data = rtrim($temp_data, ',');
                //echo $temp_data;
                $temp_result = DB::select(DB::raw("SELECT parent_id, id, name, pageId, type FROM contexts WHERE id IN ($temp_data) AND parent_id IS NOT NULL AND (type='page' || type='guide')"));
                if (sizeof($temp_result) > 0) {
                    foreach ($temp_result as $values) {
                        $parentData[] = Context::where('id', $values->parent_id)->first();
                    }
                    return $parentData;
                } else {
                    return $parentData = [];
                }
            } else {
                return [];
            }
        }
    }


    if (!function_exists('myParent')) {
        function myParent($id)
        {
            $data = [];
            return DB::select(DB::raw("SELECT parent_id, id, name, pageId type FROM contexts WHERE parent_id = $id AND  (type='page' || type='guide')"));
        }
    }


    if (!function_exists('getArray')) {
        function getArray($array, $keyName)
        {

            $arr = [];
            if (sizeof($array) > 0) {

                foreach ($array as $x => $value) {
                    $arr[] = $value->$keyName;
                }
            }
            return $arr;
        }
    }

    function getSubMenu($menuId)
    {
        return Submenu::where('menu_id', $menuId)->get();
    }

    function subProdukter($produkterId)
    {
        return SubProdukter::where('produkter_id', $produkterId)->get();
    }

    function getAreaname($id)
    {
        return Area::find($id);
    }

    function getPagename($areaId, $contextId)
    {
        $getPageId = StaticContent::where('context_id', $contextId)->where('area_id', $areaId)->first();
        $getPageId->page_id;
        return \DB::table('pagebuilder__page_translations')->where('page_id', $getPageId->page_id)->first()->route;
    }

    function getSocial($areaId)
    {
        return SocialMedia::where('area_id', $areaId)->get();
    }

    function getSocialId($areaId)
    {
        return SocialMedia::where('area_id', $areaId)->first();
    }

    function getDefaultId()
    {
        return \DB::table('default_social')->first();
    }

    function getBusinessArea()
    {
        return DB::select(DB::raw("SELECT business_area from teams GROUP BY business_area ORDER BY FIELD(business_area,'Administration','Landmåling','Landbrug','GPSnet.dk')"));
        //return Team::groupBy('business_area')->orderByRaw('FIELD (business_area,Administration,Landmåling,Landbrug,GPSnet.dk ) ASC')->get();
    }

    function getTeamByArea($businessId)
    {
        return Team::where('business_area', $businessId)->get();
    }

    function getArea_GroupWise()
    {
        return $getAreaId = \DB::table('static_area')->groupBy('area_id')->get();
    }

    function getOriginal_Parent($areaId)
    {
        $parentId = [];
        $contexts = \DB::table('static_area')->select('context_id')->where('area_id', $areaId)->groupBy('context_id')->get();
        if (sizeof($contexts) > 0) {
            foreach ($contexts as $context) {
                $parentId[] = $context->context_id;
            }
        }
        return \DB::table('pagebuilder__pages')->select('name', 'id', 'parent_id')->whereIn('id', $parentId)->get();
    }

    function getAllChild($parentId)
    {
        return \DB::select(DB::raw("SELECT B.id, B.name, B.parent_id FROM pagebuilder__pages B WHERE B.id != B.parent_id AND B.status = '1' AND B.guide = '1' AND B.parent_id ='$parentId' GROUP BY B.id;"));
    }

    function getChildRoute($pageId)
    {
        $route = \DB::table('pagebuilder__page_translations')->select('route')->where('page_id', $pageId)->first()->route;
        return url('') . $route;
    }

    function getLastvarId()
    {
        $count = Product::where('is_subscription', '1')->get()->count();
        return "VAR-00" . ($count + 1);
    }

    if (!function_exists('add_variant_products')) {
        function add_variant_products($request)
        {

            $success['success'] = 1;
            $success['message'] = "Product added successfully.";
            $success['redirect'] = "/admin/add-variant";
            $product = new Product();
            $product->api_id = $request->api_id;
            $product->api_name = $request->api_name;
            $product->short_text = $request->short_text;
            $product->description = $request->description;
            $product->meta_tag = $request->meta_tag;
            $product->meta_description = $request->meta_description;

            $product->inholder = $request->inholder;
            $product->specfication = $request->specfication;
            $product->specification2 = $request->specification2;
            $product->specification3 = $request->specification3;
            $product->specification4 = $request->specification4;

            $product->specification4_title = $request->specification4_title;
            $product->specification3_title = $request->specification3_title;
            $product->specification2_title = $request->specification2_title;
            $product->specification_title = $request->specification_title;
            $product->inholder_title = $request->inholder_title;
            $product->is_subscription = '1';
            $product->type = "Subscription";

            $product->amount = 0;

            if ($request->status != null && isset($request->status)) {
                $product->status = "$request->status";
            } else {
                $product->status = "0";
            }

            if ($request->hide_amount != null && isset($request->hide_amount)) {
                $product->hide_amount = "$request->hide_amount";
            } else {
                $product->hide_amount = "0";
            }


            $product->updated_at = date('Y-m-d H:i:s');
            $product->save();
            if (isset($request->categories)) {
                insertProductCategories($request->categories, $product);
            }

            if (isset($request->searchCategories)) {
                insertProductSearchCategories($request->searchCategories, $product);
            }

            if (isset($request->areas)) {
                insertProductAreas($request->areas, $product);
            }

            if (isset($request->contexts)) {
                insertProductContexts($request->contexts, $product);
            }


            if (isset($request->tilbehor)) {
                insertProductTilbehor($request->tilbehor, $product);
            }

            if (isset($request->Mtilbehor)) {
                insertProductMTilbehor($request->Mtilbehor, $product);
            }

            if (isset($request->related_area)) {
                foreach ($request->related_area as $rArea) {
                    $relatedArea = new RelatedArea();
                    $relatedArea->area_id = $rArea;
                    $relatedArea->product_id = $product->id;
                    $relatedArea->save();
                }
            }


            if (isset($request->passer)) {
                insertProductPasser($request->passer, $product);
            }
            if (isset($request->varProductId) && sizeof($request->varProductId) > 0) {
                foreach ($request->varProductId as $key => $varProduct) {
                    $variant = new Variant();
                    $variant->varProduct_id = $product->id;
                    $variant->product_id = $varProduct;
                    $variant->label_name = $request->label_name[$key];
                    if (isset($request->sim[$key])) {
                        $variant->sims = implode(',', $request->sim[$key]);
                    }
                    $variant->save();
                }
            }
            if (isset($request->images) && sizeof($request->images) > 0) {
                $count = 0;
                foreach ($request->images as $key => $image) {

                    $url = uploadFile($image);
                    if (preg_match('/(\.jpg|\.png|\.bmp|\.jpeg|\.gif|\.svg|\.svgz)$/', $url)) {
                        $type = 'image';
                    } else {
                        $type = 'video';
                    }
                    $data[$count]['product_id'] = $product->id;
                    $data[$count]['url'] = $url;
                    $data[$count]['type'] = $type;
                    $data[$count]['created_at'] = date('Y-m-d H:i:s');
                    $data[$count]['updated_at'] = date('Y-m-d H:i:s');
                    $count++;
                }
                $product->imagess()->createMany($data);
            }

            if (isset($request->productImages) && sizeof($request->productImages) > 0) {
                $count = 0;
                foreach ($request->productImages as $key => $image) {
                    $explode = explode('.', $image);
                    $type = end($explode);
                    $data[$count]['product_id'] = $product->id;
                    $data[$count]['url'] = $image;
                    $data[$count]['type'] = $type;
                    $data[$count]['alt_image'] = $request->altImages[$count];
                    $data[$count]['title_image'] = $request->titleImages[$count];
                    $data[$count]['created_at'] = date('Y-m-d H:i:s');
                    $data[$count]['updated_at'] = date('Y-m-d H:i:s');
                    $count++;
                }
                $product->imagess()->createMany($data);

            }

            $success['redirect'] = "/admin/add-variant";
            return $success;

        }
    }

    function getVariants($productId)
    {
        return Variant::where('varProduct_id', $productId)->get();
    }

    function getAllSim()
    {
        return Product::where('type', 'SIM')->where('status', '1')->get();
    }

    function getAllCustomSim()
    {
        return \DB::table('custom_sim')->where('id', 1)->where('status', 1)->first();
    }

    function getMetaDetails($id)
    {
        return \DB::table('pagebuilder__page_translations')->where('page_id', $id)->first();
    }

    // Filter the excel data
    function filterData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }

    function findParentId($str)
    {
        $data = \DB::table('pagebuilder__page_translations')->where('route', 'like', '%' . $str . '%')->first()->page_id;
        return \DB::table('pagebuilder__pages')->where('id', $data)->first()->parent_id;
    }

    function newsletters()
    {
        return Newsletter::find(1);
    }

    function checkCookieValue($cookie)
    {

        if (\Session::get('api_token')) {
            $pDetails = getProductPrice();
            $CustomerNo = $pDetails[1]->CustomerNo;
            $username = $pDetails[1]->Name;
            $OrganizationShortName = $pDetails[1]->OrganizationShortName;
        } else {
            $CustomerNo = '';
            $username = '';
            $OrganizationShortName = '';
        }

        if (empty($cookie)) {
//            $cookieId = \Str::random(30);
//            \Cookie::queue('myCart',$cookieId,100000);
            $basketId = Cart::where('cookieId', $cookie)->first();
            $url = "Basket/" . $basketId->basketId . "/AddProduct";
            $cartId = $basketId->basketId;
        } else {
            $basketId = Cart::where('cookieId', $cookie)->first();
            if (isset($basketId->basketId)) {
                Cart::where('basketId', $basketId->basketId)->update(['customerNo' => $CustomerNo]);
                $url = "Basket/" . $basketId->basketId . "/AddProduct";
                $cartId = $basketId->basketId;
            } else {
                $cartId = Cart::where('customerNo', $CustomerNo)->first()->basketId;
                $url = "Basket/" . $cartId . "/AddProduct";
            }

        }

        if (\Session::get('api_token') && !empty($cookie)) {
            patchApi('Basket/AddCustomerNumber', ['basketId' => $cartId, 'customerNo' => $CustomerNo]);
            Cart::where('basketId', $cartId)->update(['customerNo' => $CustomerNo]);
        }
        if (!empty($cookie) && empty(\Session::get('api_token')) && !empty($basketId->customerNo)) {
            return ['status' => 3, 'message' => 'You are not allowed to update this basket. Either because you are not logged in, or the basket belongs to another user'];
        }

        return $array = ['CustomerNo' => $CustomerNo, 'username' => $username, 'OrganizationShortName' => $OrganizationShortName, 'url' => $url];

    }

    function getProductByapi_id($request, $cookies)
    {

        $cookie = checkCookieValue($cookies);
        if (isset($cookie['message'])) {
            return $cookie;
        }
        if (isset($request['qty'])) {
            $quantity = $request['qty'];
        } else {
            $quantity = 1;
        }

        $url = $cookie['url'];
        $CustomerNo = $cookie['CustomerNo'];
        $OrganizationShortName = $cookie['OrganizationShortName'];
        $username = $cookie['username'];
        //dd($request['productId']);
        if (isset($request['productId']) && $request['productId'] != 'null') {
            $productDetails = Product::find($request['productId']);
            checkProductType($productDetails, $request['simNumber'], $url, $CustomerNo, $username, $OrganizationShortName, $quantity);
        }

        if (isset($request['extraProduct']) && $request['extraProduct'] != 'null') {
            $productDetails = Product::where('api_id', $request['extraProduct'])->first();
            checkProductType($productDetails, $request['simNumber'], $url, $CustomerNo, $username, $OrganizationShortName, $quantity);
        }

        if (isset($request['phy_productId'])) {
            $productDetails = Product::find($request['phy_productId']);
            checkProductType($productDetails, $request['simNumber'], $url, $CustomerNo, $username, $OrganizationShortName, $quantity);
        }
//        if (isset($request['v_productId']) && $request['v_productId'] != 'null') {
//            $productDetails = Product::find($request['v_productId']);
//            checkProductType($productDetails, $request['simNumber'], $url, $CustomerNo, $username, $OrganizationShortName);
//        }

    }

    function checkProductType($productDetails, $simNumber, $url, $CustomerNo, $username, $OrganizationShortName, $quantity)
    {

        // try {
//        echo "<pre>";
//         print_r($productDetails);
//         die;

        if ($productDetails->type == "SIM" || $productDetails->type == "Hotline" || $productDetails->type == "ServiceAgreement") {   /// NonGPSNetSubscription Products
            $mRealted = Maccessory::select('relatedProduct')->where('product_id', $productDetails->id)->get();
            if (sizeof($mRealted) > 0) {
                foreach ($mRealted as $related) {
                    $relatedDetails = Product::find($related->relatedProduct);
                    addCartNonGPSNetSubscription($relatedDetails, $url, $CustomerNo, $quantity);
                }
            }
            addCartNonGPSNetSubscription($productDetails, $url, $CustomerNo, $quantity);
        }

        if ($productDetails->type == "Subscription" || $productDetails->type == "GPSNetSubscription") {   /// GPSNetSubscription Products
            $mRealted = Maccessory::select('relatedProduct')->where('product_id', $productDetails->id)->get();
            if (sizeof($mRealted) > 0) {
                foreach ($mRealted as $related) {
                    $relatedDetails = Product::find($related->relatedProduct);
                    addCartGPSNetSubscription($relatedDetails, $simNumber, $url, $CustomerNo, $username, $OrganizationShortName, $quantity);
                }
            }
            addCartGPSNetSubscription($productDetails, $simNumber, $url, $CustomerNo, $username, $OrganizationShortName, $quantity);
        }

        if ($productDetails->type == "Physical") {   /// Physical Products
            $mRealted = Maccessory::select('relatedProduct')->where('product_id', $productDetails->id)->get();
            if (sizeof($mRealted) > 0) {
                foreach ($mRealted as $related) {
                    $relatedDetails = Product::find($related->relatedProduct);
                    addCartPhysical($relatedDetails, $url, $CustomerNo, $quantity);
                }
            }
            addCartPhysical($productDetails, $url, $CustomerNo, $quantity);
        }
//        }catch (\Exceptionn $exception){
//            return $exception->getMessage();
//        }
    }

    function addCartPhysical($product, $url, $CustomerNo, $quantity)
    {
        // try {
        $api_url = env('BASE_API_URL');
        $token = \Session::get('api_token');
        if ($product->short_text != '') {
            $productDetails = $product->short_text;
        } else {
            $productDetails = "Description Not Available For This Product";
        }
        $dataObj = array();
        $dataObj['customerNumber'] = $CustomerNo;
        $dataObj['productList'] = array();
        $dataObj['productList'][0] = new \stdClass;
        $dataObj['productList'][0]->productNumber = $product->api_id;
        $dataObj['productList'][0]->requestedQuantity = $quantity;
        $responsePrice = postApi('Product/Prices', $dataObj);
        $unitPrice = $responsePrice[0]->unitPrice;
        $sellPrice = $responsePrice[0]->basePrice;
        $array = [
            'productType' => $product->type,
            'productNumber' => $product->api_id,
            'description' => $productDetails,
            'quantity' => $quantity,
            'unitPrice' => $unitPrice,
            'sellPrice' => $sellPrice,
            'vendorItemNo' => ''
        ];

        if (\Session::get('api_token')) {
            $response = \Http::withToken($token)->post($api_url . $url, $array);
        } else {
            $response = \Http::post($api_url . $url, $array);
        }
        if ($response->getStatusCode() == 401) {
            $response = json_decode($response);
            $array = ['status' => 3, 'message' => $response->message];
            print_r($array);

        }
//echo "<pre>";
//        print_r(json_decode($response));
//        }catch (\Exception $e)
//        {
//            return $e->getMessage();
//        }
    }

    function addCartNonGPSNetSubscription($product, $url, $CustomerNo, $quantity)
    {
        //try {
        $api_url = env('BASE_API_URL');
        $token = \Session::get('api_token');
        if ($product->short_text != '') {
            $productDetails = $product->short_text;
        } else {
            $productDetails = "Description Not Available For This Product";
        }
        $dataObj = array();
        $dataObj['customerNumber'] = $CustomerNo;
        $dataObj['productList'] = array();
        $dataObj['productList'][0] = new \stdClass;
        $dataObj['productList'][0]->productNumber = $product->api_id;
        $dataObj['productList'][0]->requestedQuantity = $quantity;
        $responsePrice = postApi('Product/Prices', $dataObj);
        $unitPrice = $responsePrice[0]->unitPrice;
        $sellPrice = $responsePrice[0]->basePrice;
        $array = [
            'vendorItemNo' => '',
            'productType' => $product->type,
            'productNumber' => $product->api_id,
            'description' => $productDetails,
            'quantity' => $quantity,
            'unitPrice' => $unitPrice,
            'sellPrice' => $sellPrice,
            'subscriptionDetails' => (object)[
                'startDate' => date('Y-m-d'),
                'duration' => (object)[
                    'durationValue' => 3,
                    'durationUnit' => 'Å',
                ],
            ],
        ];

        if (\Session::get('api_token')) {
            $responses = \Http::withToken($token)->post($api_url . $url, $array);
        } else {
            $responses = \Http::post($api_url . $url, $array);
        }
        if ($responses->getStatusCode() == 401) {
            $response = json_decode($responses);
            $array = ['status' => 3, 'message' => $response->message];
            print_r($array);

        }
//        echo "<pre>";
//        print_r(json_decode($responses));
//        }catch(\Exception $e)
//        {
//            return $e->getMessage();
//        }
    }

    function addCartGPSNetSubscription($product, $simNumber, $url, $CustomerNo, $username, $OrganizationShortName, $quantity)
    {
        // try {
        $api_url = env('BASE_API_URL');
        $token = \Session::get('api_token');
        if ($product->short_text != '') {
            $productDetails = $product->short_text;
        } else {
            $productDetails = "Description Not Available For This Product";
        }
        $dataObj = array();
        $dataObj['customerNumber'] = $CustomerNo;
        $dataObj['productList'] = array();
        $dataObj['productList'][0] = new \stdClass;
        $dataObj['productList'][0]->productNumber = $product->api_id;
        $dataObj['productList'][0]->requestedQuantity = $quantity;
        $responsePrice = postApi('Product/Prices', $dataObj);
        if (isset($responsePrice->message)) {
            $unitPrice = 0;
            $sellPrice = 0;
        } else {
            $unitPrice = $responsePrice[0]->unitPrice;
            $sellPrice = $responsePrice[0]->basePrice;
        }

        $array = [
            'vendorItemNo' => '',
            'productType' => 'GPSNetSubscription',
            'productNumber' => $product->api_id,
            'description' => $productDetails,
            'quantity' => $quantity,
            'unitPrice' => $unitPrice,
            'sellPrice' => $sellPrice,
            'subscriptionDetails' => (object)[
                'simNo' => $simNumber,
                'gpsNetOrganization' => $OrganizationShortName,
                'startDate' => date('Y-m-d'),
                'username' => $username,
                'addTDCSim' => true,
                'duration' => (object)[
                    'durationValue' => 3,
                    'durationUnit' => 'Å',
                ],
            ],
        ];

        if (\Session::get('api_token')) {
            $response = \Http::withToken($token)->post($api_url . $url, $array);
        } else {
            $response = \Http::post($api_url . $url, $array);
        }
        if ($response->getStatusCode() == 401) {
            $response = json_decode($response);
            $array = ['status' => 3, 'message' => $response->message];
            print_r($array);

        }


//        }catch(\Exception $e)
//        {
//            return $e->getMessage();
//        }
    }


    function getCartDetails()
    {
        $cookies = \Cookie::get('myCart');
        //dd($cookies);
        $basket = Cart::where('cookieId', $cookies)->first();
        if (isset($basket->basketId)) {
            $basketId = $basket->basketId;
        } else {
            $basketId = '';
        }

        if (\Session::get('api_token')) {
            $token = \Session::get('api_token');
        } else {
            $token = '';
        }

        if (!empty($token) && !empty($basketId)) {
            $url = env('BASE_API_URL') . "Basket/" . $basketId;
            $response = Http::withToken($token)->get($url);
            $response = json_decode($response);

            if (!isset($response->message)) {
                return ['cartCnt' => sizeof($response->lines), 'cartList' => $response];
            } else {
                return ['cartCnt' => 0, 'cartList' => array()];
            }
        }

        if (empty($token) && !empty($basketId)) {
            $url = env('BASE_API_URL') . "Basket/" . $basketId;
            $response = Http::get($url);
            $response = json_decode($response);
            if (!isset($response->message)) {
                return ['cartCnt' => sizeof($response->lines), 'cartList' => $response];
            } else {
                return ['cartCnt' => 0, 'cartList' => array()];
            }
        }

        if (!empty($token) && empty($basketId)) {
            $pDetails = getProductPrice();
            $getBasket = Cart::where('customerNo', $pDetails[1]->CustomerNo)->first();
            if (isset($getBasket->basketId)) {
                $basketId = $getBasket->basketId;
                $url = env('BASE_API_URL') . "Basket/" . $basketId;
                $response = Http::withToken($token)->get($url);
                $response = json_decode($response);
//                dd($response);
                if (!isset($response->message)) {
                    return ['cartCnt' => sizeof($response->lines), 'cartList' => $response];
                } else {
                    return ['cartCnt' => 0, 'cartList' => array()];
                }
            }
        }
        return ['cartCnt' => 0, 'cartList' => array()];
    }

    if (!function_exists('cartListNew')) {
        function cartListNew($array)
        {
            $cartPrice = [];
            $productApiPrices = getProductAPpiArr($array);
            if (!isset($productApiPrices->message)) {
                foreach ($productApiPrices as $priceApi) {
                    if (isset($priceApi->productNumber)) {
                        $cartPrice[$priceApi->productNumber] = $priceApi;
                    }

                }
            }
            return $cartPrice;
        }
    }

    function getProductImage($productId)
    {
        return \DB::table('products')->select('product_images.url', 'products.api_name', 'products.id', 'products.hide_amount')
            ->leftJoin('product_images', 'products.id', '=', 'product_images.product_id')
            ->where('products.api_id', $productId)
            ->first();
    }

    function kontakat_os()
    {
        return Content::where('page','kontakt_page')->get();
    }

    function bliv_ringet()
    {
        return Content::where('page','bliv_ringet')->get();
    }


    function getArea()
    {
        return Area::orderBy('rank','ASC')->get();
    }

    function homePageData()
    {
        return Content::where('page','home_page')->get();
    }

    function homeVideo($vid){
        if ($vid == 0){
            return \DB::table('homevideos')->inRandomOrder()->limit(1)->first()->url;
        }else{
            return \DB::table('homevideos')->where('id',$vid)->first()->url;
        }
    }

    function dynamicHeader($current_uri)
    {
        return DB::select( DB::raw("select pagebuilder__page_translations.title, pagebuilder__page_translations.route  from pagebuilder__pages left join pagebuilder__page_translations
    on pagebuilder__page_translations.page_id = pagebuilder__pages.id where pagebuilder__page_translations.route  = '$current_uri'") );
    }

    function getProdukters()
    {
        return Produkter::orderBy('rank','ASC')->get();
    }

    function getSub_produkters($produkter_id){
      return SubProdukter::where('produkter_id',$produkter_id)->get();
    }

    function getMenu()
    {
        return Menu::where('status',1)->get();
    }
	
	

}
