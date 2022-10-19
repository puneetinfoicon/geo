<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\RelatedArea;
use Illuminate\Support\Facades\Http;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPageBuilder\Core\DB;
use Redirect, Session;
use Validator;
use Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\VerifyUser;
use App\Models\ResetUser;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\Area;
use App\Models\Faq;
use App\Models\Context;
use Exception;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->cart_info = session()->get('api_token');
                if ($this->cart_info !=null){
                    $token = $this->cart_info;
                    $api_url = env('BASE_API_URL').'AccountDetails';
                    $response = Http::withToken($token)->get($api_url, $array=null);
                    if ($response->getStatusCode() != 200) {
                        return redirect()->route('adminLogout');
                    }
                }
            return $next($request);
        });
    }

    public function index()
    {
        try {
            $resultContent = getContent("home_page");
            $showClass = 1;
            return view('index', ["showClass" => $showClass, "content" => $resultContent['content']]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function staticUser()
    {
        return view('staticUser');
    }

    public function gpsnet()
    {
        return view('gpsnet');
    }

    public function nyhed()
    {
        return view('nyhed');
    }

    public function produktkategori(Request $request, $id)
    {
        try {

            // addCookie('produktkategori',$id);
            $area = Area::find($id);
            $areaId = RelatedArea::where('area_id', $id)->pluck('product_id');
            $data['footerAreaId'] = $id;
            $categoryArr = array();
            $data['products'] = $productResult = Product::where('status', '1')->whereIn('id', $areaId)->get();

            foreach ($area->products->where('status', '1') as $product) {  // if u want to display all area category
                // foreach ($productResult as $product) {    // If u want to display only related product category
                foreach ($product->categories as $category) {
                    $categoryArr[$category->id] = $category->toArray();
                }
            }

            //sort categories as per ranking
            $orderArray = Category::orderBy('rank', 'ASC')->pluck('id')->toArray();
            $ordered = array();
            foreach ($orderArray as $key) {
                if (array_key_exists($key, $categoryArr)) {
                    $ordered[$key] = $categoryArr[$key];
                    unset($categoryArr[$key]);
                }
            }

            $productApiPrices = getProductAPpiObj($productResult);
            // echo "<pre>"; print_r($productApiPrices); die;
            foreach ($productApiPrices as $priceApi) {
//                echo "<pre>"; print_r($priceApi);
                if (isset($priceApi->productNumber)) {
                    $data['productApiPrices'][$priceApi->productNumber] = $priceApi;
                }
            }

            // //sort categories as per ranking
            $categoryArr = $ordered;
            $orderArray = $categoryArr;
            $data['area'] = $area;
            $data['categories'] = $categoryArr;
            $data['areaId'] = $id;
            $data['menus'] = Menu::where('status', 1)->get();
            return view('products.produktkategori', $data);
        } catch (\Exception $e) {
            // return $e->getMessage();
            return redirect()->back();
        }
    }

    public function produkttype(Request $request, $categoryId, $areaId = null)
    {
        try {
            $array['menus'] = Menu::where('status', 1)->get();
            $data['areaId'] = $areaId;
            $array['footerAreaId'] = $areaId;
            $data['categoryId'] = $categoryId;
            $productResult = getAllProductCategories($data);
            $productApiPrices = getProductAPpiObj($productResult['products']);

            foreach ($productApiPrices as $priceApi) {
//                echo "<pre>"; print_r($priceApi);
                if (isset($priceApi->productNumber)) {
                    $array['productApiPrices'][$priceApi->productNumber] = $priceApi;
                }

            }

            $array['products'] = $productResult['products'];
            $array['area'] = Area::find($areaId);
            $array['category'] = Category::find($categoryId);
            return view('products.produkttype', $array);
        } catch (\Exception $e) {
            // return $e->getMessage();
            return redirect()->back();
        }
    }

    public function produkt(Request $request, $areaid, $id, $name)
    {
        try {
            $data['menus'] = Menu::where('status', 1)->get();
            $data['productDetails'] = Product::find($id);
            $product = Product::find($id);

            $pDetails = getProductPrice();
            // echo "<pre>"; print_r($pDetails); die;
            //            $pDetails = getProductPrice($data['productDetails']->api_id);
            if ($pDetails != null) {
                $customerNo = $pDetails[1]->CustomerNo;
            } else {
                $customerNo = "";
            }
            $dataObj = array();
            $dataObj['customerNumber'] = $customerNo;
            $dataObj['productList'] = array();
            $dataObj['productList'][0] = new \stdClass;
            $dataObj['productList'][0]->productNumber = $data['productDetails']->api_id;
            $dataObj['productList'][0]->requestedQuantity = 1;
            // echo "<pre>"; print_r($dataObj); die;
            $response = postApi('Product/Prices', $dataObj);
            //echo "<pre>"; print_r($response); die;
            $data['productDetails']->price = $response;


            if (empty($product)) {
                session()->flash('alert-class', 'success');
                session()->flash('message', "Something went wrong.");
                return redirect()->back();
//            return redirect('/');
            } elseif ($product->status != 1) {
                if (Auth::user() && Auth::user()->hasRole('admin')) {

                } else {
                    session()->flash('alert-class', 'success');
                    session()->flash('message', "Not authorise to view this page.");
                    return redirect()->back();
//                return redirect('/');
                }
            }

            $passer = [];
            $related = [];
            // echo "<pre>"; print_r($product->accessoriess->toArray()); echo "</pre>"; die;
            foreach ($product->passerss as $key => $accessory) {
                $passer[] = $accessory->get_products;
            }

            foreach ($product->accessoriess as $key => $assocs) {
                $related[] = $assocs->get_products;
            }

            $productApiPrices = getProductAPpiObj($related);
            $passerPrices = getProductAPpiObj($passer);
            //echo "<pre>"; print_r($passerPrices); echo "</pre>"; die;
            foreach ($productApiPrices as $priceApi) {
                if (isset($priceApi->productNumber)) {
                    $data['productApiPrices'][$priceApi->productNumber] = $priceApi;
                }

            }
            foreach ($passerPrices as $ppriceApi) {
                if (isset($ppriceApi->productNumber)) {
                    $data['parserPrices'][] = $ppriceApi;
                    // echo "<pre>";
                    // print_r($data['parserPrices'][$priceApi->productNumber]);
                }

            }

            //echo "<pre>"; print_r($data['parserPrices']); echo "</pre>"; die;
            $data['passer'] = $passer;
            $data['related'] = $related;
            $data['areaId'] = $areaid;
            $data['area'] = Area::find($areaid);
            $data['footerAreaId'] = $areaid;
            if ($areaid != 'null') {
                $data['areaName'] = Area::find($areaid)->name;
            }

            return view('products.produkt', $data);
        } catch (\Exception $e) {
            if ($e->getMessage() == "cURL error 6: Could not resolve host: Product (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for Product/Prices") {
                return redirect()->back();
            }
        }
    }

    public function login_register()
    {
        $menus = Menu::where('status', 1)->get();
        $details = Content::where('name', 'login')->orWhere('name', 'signup')->orWhere('name', 'signup_footer')->orWhere('name', 'signup_footerLink')->orWhere('name', 'signup_footer_contentLink')->get();
        return view('login_register', ["menus" => $menus, "details" => $details,]);
    }

    public function contact()
    {
        $resultContent = getContent("contact");
        $teams = getAllTeamMembers();
        $menus = Menu::where('status', 1)->get();
        return view('static.contacts.contact', ["content" => $resultContent['content'], "teams" => $teams, "menus" => $menus]);
    }

    public function about()
    {
        $menus = Menu::where('status', 1)->get();
        $resultContent = getContent("om_os");
        return view('static.about', ["content" => $resultContent['content'], "menus" => $menus]);
    }

    public function admin()
    {
        return redirect('admin/ecommerce-products-list');
        // return view('admin.index');
    }

    public function service()
    {
        $menus = Menu::where('status', 1)->get();
        $resultContent = getContent("service");
        return view('static.services.service', ["content" => $resultContent['content'], "menus" => $menus]);
    }


    public function create_account(Request $request)
    {
        $result = createAccount($request);
        session()->flash('alert-class', 'success');
        session()->flash('message', $result['message']);
        return redirect($result['redirect']);
    }


    public function verifyUser($token)
    {
        $user = VerifyUser::where('token', $token)->first();
        $message = "User not found. Please check link.";

        if ($user != null) {
            if ($user->get_users->status == 0) {
                $user->get_users->status = "1";
                $user->get_users->save();
                $message = "User verified Successfully. Please Login.";

            } else {
                $message = "User already verified. Please check link.";
            }
        }

        session()->flash('alert-class', 'success');
        session()->flash('message', $message);
        return redirect()->route('login-register');
    }

    public function submitForgetPassword(Request $request)
    {
        $result = ForgetPasswordEmail($request);

        session()->flash('alert-class', 'success');
        session()->flash('message', $result['message']);

        return redirect($result['redirect']);
    }

    public function resetPassUser($token)
    {
        $user = ResetUser::where('token', $token)->first();

        if ($user == null) {
            $message = "User not found. Please check link.";
            session()->flash('alert-class', 'success');
            session()->flash('message', $message);
            return redirect()->route('login-register');
        }

        return view('resetPassword', ['token' => $token]);
    }

    public function submitResetPassword(Request $request)
    {
        $token = $request->token;
        $user = ResetUser::where('token', $token)->first();

        if ($user == null) {
            $message = "User not found. Please check link.";
            session()->flash('alert-class', 'success');
            session()->flash('message', $message);
            return redirect('/login');
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required',
        ]);

        if ($validator->fails()) {

            session()->flash('alert-class', 'success');
            session()->flash('message', $validator->errors()->first());
            return redirect("/reset-password/$token");

        }

        $user->get_users->password = Hash::make($request->password);
        $user->get_users->updated_at = date('Y-m-d H:i:s');
        $user->get_users->save();

        $message = "Password changed Successfully. Please Login to continue.";
        session()->flash('alert-class', 'success');
        session()->flash('message', $message);

        return redirect()->route('login-register');
    }

    public function support_landbrug()
    {
        $resultContent = getContent("support_landbrug");
        return view('static.services.support_landbrug', ["content" => $resultContent['content']]);
    }

    public function searchProdukt(Request $request)
    {
        // $data['areas']          = Area::whereHas('products',function( $query ) { $query->where('status','1'); })->get();
        $data['areas'] = Area::all();
        $data['categories'] = Category::all();
        $categoryProductCount = array();
        $data['menus'] = Menu::where('status', 1)->get();

        $data['name'] = '';
        if (isset($request->name)) {
            $data['name'] = $request->name;
        }

        foreach ($data['areas'] as $key => $area) {

            if (isset($request->name)) {
                $name = $request->name;

                $products = $area->products()->where(function ($query) use ($name) {
                    $query->where('api_id', 'like', '%' . $name . '%');
                    $query->orWhere('api_name', 'like', '%' . $name . '%');

                    $query->orWhereHas('search_categories', function ($query) use ($name) {
                        $query->where('name', 'like', '%' . $name . '%');
                    });

                    $query->orWhereHas('contexts', function ($query) use ($name) {
                        $query->where('name', 'like', '%' . $name . '%');
                    });
                })->get();

            } else {
                $products = $area->products;
            }

            if (sizeof($products) > 0) {
                foreach ($products as $key => $product) {
                    if ($product->status == 1) {
                        if (sizeof($product->categories) > 0) {
                            foreach ($product->categories as $key => $category) {

                                if (!isset($categoryProductCount[$area->id][$category->id])) {
                                    $categoryProductCount[$area->id][$category->id] = 1;
                                } else {
                                    $categoryProductCount[$area->id][$category->id]++;
                                }
                            }
                        }
                    }
                }
            }
        }
        $data['categoryProductCount'] = $categoryProductCount;
        $data['contentCount'] = getContentCount($request);

        return view('products.search_result', $data);
    }

    public function getProdukt_Result(Request $request)
    {

        $areaCategory = array();
        $data = array();
        $count = 0;
        $request1 = array();
        $contextAreaIds = array();
        $requestContext = array();
        $content = array();
        $page = array();

        if (isset($request->data) && sizeof(json_decode($request->data)) > 0) {   // check category and diff as per category and areaId

            $data = json_decode($request->data);
            //echo "<pre>"; print_r($data); die;
            foreach ($data as $area => $areaCategory) {

                foreach ($areaCategory as $area => $category) {
                    $request1[$area][] = $category;
                    $count++;
                }

            }
        }
//echo "<pre>"; print_r($request1); die;
        // Get filter areas from Frontend start
        if (isset($request->content_area) && sizeof(json_decode($request->content_area)) > 0) {
            $contextAreaIds = json_decode($request->content_area);
        }
        // echo "<pre>"; print_r($request1); die;
//        $contextAreaIds[] = 1;
        // Get filter areas from Frontend end


        $requestContext = array('guide', 'video', 'page', 'link', 'file', 'manual');
        $result = searchProduct($request1, $request, $requestContext);
//         print_r($result['products']);
//         die;


        if (sizeof($result['products']) > 0) {
            $tempData = getProductAPpiObj(($result['products']));

            if (!isset($tempData->message)) {
                $result['productApiPrices'] = createPriceData(getProductAPpiObj(($result['products']), $customerNo = null, $qty = null));

                if (sizeof($result['productApiPrices']) > 0) {

                    foreach ($result['products'] as $key => $product) {
                        if (isset($result['productApiPrices'][$product->api_id])) {
                            $product->priceApi = $result['productApiPrices'][$product->api_id];

                        }
                    }

                }
            }
        }
//print_r($result['productApiPrices']);
        $result['content'] = array();
        $result['page'] = array();

        if (isset($request->name) && !empty($request->name) && $request->name != '') {
            if (sizeof($requestContext) > 0) {

                // search documents with params start
                $requestContextCopy = $requestContext;
                if (($key = array_search('link', $requestContextCopy)) !== false) {
                    unset($requestContextCopy[$key]);
                }

                if (($key = array_search('page', $requestContextCopy)) !== false) {
                    unset($requestContextCopy[$key]);
                }

                if (sizeof($requestContextCopy) > 0) {
                    $content = searchContentParam($request->name, 'file', $requestContextCopy, $contextAreaIds);
                }
                // search documents with params end

                // search pages with params start
                $requestContextCopy = $requestContext;

                if (($key = array_search('manual', $requestContextCopy)) !== false) {
                    unset($requestContextCopy[$key]);
                }

                if (($key = array_search('guide', $requestContextCopy)) !== false) {
                    unset($requestContextCopy[$key]);
                }

                if (($key = array_search('file', $requestContextCopy)) !== false) {
                    unset($requestContextCopy[$key]);
                }

                if (($key = array_search('video', $requestContextCopy)) !== false) {
                    unset($requestContextCopy[$key]);
                }

                if (sizeof($requestContextCopy) > 0) {
                    $page = searchContentParam($request->name, 'page', $requestContextCopy, $contextAreaIds);
                }
                // search pages with params end
            }

        } else {

            $content = searchContent('file', $contextAreaIds);
            $page = searchContent('page', $contextAreaIds);

        }

        $result['page'] = $page;
        $result['content'] = $content;
        return response()->json($result);

    }

    public function searchContent($key)
    {
        $result = searchContent('page');
        return response()->json($result);
    }

    public function filterFaqResult(Request $request)
    {
        $result = array();
        if (isset($request->filter) && sizeof(json_decode($request->filter)) > 0) {

            $areas = json_decode($request->filter);
            $faqs = Faq::where('status', '1')->whereHas('areas', function ($q) use ($areas) {
                $q->whereIn('areas.id', $areas);
            })->get();

        } else {

            $faqs = Faq::where('status', '1')->get();
        }

        $result['faqs'] = $faqs;
        return response()->json($result);
    }

    public function trimbleAccess(Request $request)
    {
        $data = [];
        $data['menus'] = Menu::where('status', 1)->get();
        return view('trimble', $data);
    }

    public function getTrimble(Request $request)
    {
        $keyfind = "service-support/" . $request->page;
        if (sizeof(getArea_GroupWise()) > 0) {
            $key = 1;
            foreach (getArea_GroupWise() as $areaId) {

                echo "<h3>" . getAreaname($areaId->area_id)->name . "</h3>";

                if (sizeof(getOriginal_Parent($areaId->area_id)) > 0) {
                    foreach (getOriginal_Parent($areaId->area_id) as $parents) {
                        if (findParentId($keyfind) == $parents->id) {
                            $checked = "checked";
                            $active = "active";
                        } else {
                            $checked = "";
                            $active = "";
                        }
                        echo '<div class="accordion-bral">
                            <input class="ac-input" id="' . $parents->id . $key . '" name="accordion-1" type="checkbox" ' . $checked . '>
                            <label class="ac-label toggle-btn ' . $active . '" for="' . $parents->id . $key . '" >
                                <span class="arrow"></span>' . $parents->name . '</label>
                            <div class="article ac-content">
                                <div class="content-aa">
                                    <ul>';
                        if (sizeof(getAllChild($parents->id)) > 0) {
                            foreach (getAllChild($parents->id) as $childs) {
                                echo '<li><a href="' . getChildRoute($childs->id) . '">' . $childs->name . '</a></li>';
                            }
                        }
                        //<li><a href="#">Hvad er nyt?</a></li>
                        echo '</ul>
                                </div>
                            </div>
                        </div>';
                    }
                }
                $key++;
            }
        }
    }

    public function getChildPage(Request $request)
    {
        echo \DB::table('pagebuilder__pages')->select('data')->where('id', $request->page)->first()->data;
    }


    public function landburg_mailchimp($email)
    {
        try {
            $list_id = '67e9940438';
            $api_key = '1c34752d9635e8cf9b69882126bffddc-us10';

            $data_center = substr($api_key, strpos($api_key, '-') + 1);
            $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members';
            $json = [
                'email_address' => $email,
                'status' => 'subscribed', //pass 'subscribed' or 'pending'
            ];

            $response = Http::withBasicAuth('anystring', $api_key)->post($url, $json);
            if (200 == $response->getStatusCode()) {
                return ['status' => $response->getStatusCode(), 'message' => "You have successfully subscribed to our newsletter."];
            } else {
                return ['status' => $response->getStatusCode(), 'message' => "Sorry! You have already subscribed to our newsletter."];
            }
        } catch (\Exception $e) {
            return ['status' => 500, 'message' => $e->getMessage()];
        }
    }


    public function landmailing_mailchimp($email)
    {

        try {
            $list_id = '89338df294';
            $api_key = '1c34752d9635e8cf9b69882126bffddc-us10';

            $data_center = substr($api_key, strpos($api_key, '-') + 1);
            $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members';
            $json = [
                'email_address' => $email,
                'status' => 'subscribed', //pass 'subscribed' or 'pending'
            ];

            $response = Http::withBasicAuth('anystring', $api_key)->post($url, $json);
            if (200 == $response->getStatusCode()) {
                return ['status' => $response->getStatusCode(), 'message' => "You have successfully subscribed to our newsletter."];
            } else {
                return ['status' => $response->getStatusCode(), 'message' => "Sorry! You have already subscribed to our newsletter."];
            }
        } catch (\Exception $e) {
            return ['status' => 500, 'message' => $e->getMessage()];
        }
    }

    public function mailchimp(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return ['status' => 0, 'message' => $validator->errors()->first()];
        }

        if (!empty($request->landburg)) {
            return $burg = $this->landburg_mailchimp($request->email);
        }
        if (!empty($request->landmailing)) {
            return $mailing = $this->landmailing_mailchimp($request->email);
        }

    }

    public function sendEmail_kontakt(Request $request)
    {
        $api_url = env('BASE_API_URL')."Mail";
        if (Session::get('api_token')) {
            $token = Session::get('api_token');
        }else{
            return ['status'=>0,'message'=>'Unauthorized!!!'];
        }

        $response = Http::withToken($token)->post($api_url, $request->all());
        if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
            return ['status'=>1,'message'=>"Thanks! We will contact you soon."];
        }else{
            return ['status'=>0,'message'=>json_decode($response)->message];
        }
    }


}
