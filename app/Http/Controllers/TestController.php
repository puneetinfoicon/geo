<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;
use App\Models\Category;
use App\Models\Area;
use App\Models\Content;
use App\Models\Context;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use Str;
use App\Models\SearchCategory;
use App\Models\Role;
use App\Models\User;
use Exception;
use NZTim\Mailchimp\Mailchimp;

class TestController extends Controller
{
    public function test()
    {
        echo "<pre>";
        $cartDetails = getCartDetails();
        $tp = [];
        foreach($cartDetails['cartList']->lines as $cartData){
           // print_r(getProductImage($cartData->productNumber));
            $arr['api_id'] =  $cartData->productNumber;
            $arr['quantity'] =  $cartData->quantity;
            array_push($tp,$arr);
        }
        $cartPrice = cartListNew($tp);
        print_r($cartDetails['cartList']);


//        $array = areaContent(2);
//        echo sizeof($array);
die;
            $result = Http::withHeaders(['Authorization'=> 'Shop tajc00kdX72gmVbJXZXv2XbAqccQNQOlJO6NTXAR','accept'=>'application/json'])->get('https://udvnavintegration.le34.dk/Product');
         echo "<pre>";
         print_r(json_decode($result));
        die;
        $result = json_decode(getApi('Product', null), true);
        echo "<pre>";
        print_r($result);
        die;
        // $data['url']    = "https://udvnavintegration.le34.dk/Customer"; // customer API
        $data['url'] = "https://udvnavintegration.le34.dk/Product"; // product API
        // $data['url']    = "https://udvnavintegration.le34.dk/GPSNetOrganization"; // GPSNetOrganization API

        // $data['url']    = $_GET['url'];
        $token = env('TOKEN');
        $data['token'] = "Bearer $token ";
        $json = getThirdPartyApi($data);
        // $json           = postThirdPartyApi($data);
        echo "<pre>";
        print_r($json);
        echo "</pre>";
        die;
    }

    public function test_mail()
    {


        // $body = '<p style="font-family: Roboto, Arial, sans-serif;font-size: 14px;color: #767676; margin: 0;margin-bottom: 14px;line-height: 22px">
        //                                 Please click <a
        //                                     href="https://www.domidom.fr/" style="text-decoration: none;color: #03a9f4;">here</a> to verify your email address. If you did not create an account, no further action is required.
        //                             </p>';


        // $details = [
        //     'body'      => $body,
        //     'to'        => 'chaitanyas082@gmail.com',
        //     'subject'   => 'Geoteam - Confirm Your Registration',
        //     'name'      => 'Chaitanya Swami',
        // ];

        // \Mail::to($details['to'])->send(new \App\Mail\MyTestMail($details));
    }


    public function test_chat()
    {
        // SELECT * FROM `contexts` WHERE (type='page' || type='guide');
        // mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi

        // $url = "media/1655802586/mov_bbb.mp4";
        // if (preg_match('/(\.jpg|\.png|\.bmp|\.jpeg|\.gif|\.svg|\.svgz)$/', $url)) {
        //     $type = 'image';
        // }else{
        //     $type = 'video';
        // }

        // echo "<pre>"; print_r($type); echo "</pre>";

        // $category = Area::find(1);
        // $contents = Context::find(1);
        // $contents->areas()->attach($category);

//         $data['areas'] = Area::all();
//         foreach ($data['areas'] as $key => $area) {
//
//
//             echo "<pre>"; print_r($area->contexts->count()); echo "</pre>";
//             echo "<pre>"; print_r(Cookie::get('name')); echo "</pre>";
//         }
        // $array = json_encode(array(1,2,2,3,3,5,5,9,548));
        // Cookie::queue('name', $array, 10000);
        // echo "<pre>"; print_r( json_decode(Cookie::get('name'))); echo "</pre>";


        // $productId  = 5;
        // $qty        = 0;
        updataCart("94267", 0);
        // // deleteCookie('cart');
        //  echo "<pre>"; print_r( (json_decode(Cookie::get('cart')))); echo "</pre>";

//            $token = "hwdqc2kYz79TnyGsHLw2RFIG1ynHf5";
//            $shareCart = updateShareCartCookie($token);
//
//            echo "<pre>"; print_r( $shareCart); echo "</pre>";


        /******  Get parents and child *********/

        $service_context = getRootParent();
        getParent($service_context);
        $contexts = getParent($service_context);

//        $contexts = DB::select(DB::raw("SELECT parent_id, id, name, type FROM contexts WHERE id IN ($temp_data) AND parent_id IS NULL AND (type='page' || type='guide')"));
//        $contexts = DB::select(DB::raw("SELECT parent_id, id, name, type FROM contexts WHERE id IN (SELECT parent_id FROM contexts WHERE parent_id IN ('1','5','6','8','4')) AND (type='page' OR type='guide')"));
        echo "<pre>";
        // print_r($contexts);
        $parent = myParent(30);
        print_r($parent);
        die;
        foreach ($contexts as $child) {
            print_r($child);
            $childQuery = DB::table('contexts')->where('parent_id', $child->id)->get()->toArray();
            foreach ($childQuery as $subChild) {
                $subChildQuery = DB::table('contexts')->where('parent_id', $subChild->id)->get()->toArray();
                print_r($subChildQuery);
            }
            print_r($childQuery);
        }


    }

    function capture()
    {
        return view('test.test');
    }

    function authorizeSubscription()
    {

        $accessToken = "a8XLxQ6lpvr5xV8FI2nd";
        $merchantNumber = "T806323301";
        $secretToken = "7dYWApnEduNlWNb8EjcJWsBhRrTjSzJWBrkW8alh";

        $apiKey = base64_encode(
            $accessToken . "@" . $merchantNumber . ":" . $secretToken
        );

        $checkoutUrl = "https://api.v1.checkout.bambora.com/sessions";

        $request = array();
        $request["order"] = array();
        $request["order"]["id"] = "OD1234213432";
        $request["order"]["amount"] = "19500";
        $request["order"]["currency"] = "DKK";

        $request["url"] = array();
        $request["url"]["accept"] = "http://localhost/geoteam_new/cart";
        $request["url"]["cancel"] = "http://localhost/geoteam_new/";
        $request["url"]["callbacks"] = array();
        $request["url"]["callbacks"][] = array("url" => "https://example.org/callback");

        $requestJson = json_encode($request);

        $contentLength = isset($requestJson) ? strlen($requestJson) : 0;

        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . $contentLength,
            'Accept: application/json',
            'Authorization: Basic ' . $apiKey
        );

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $requestJson);
        curl_setopt($curl, CURLOPT_URL, $checkoutUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $rawResponse = curl_exec($curl);
        $response = json_decode($rawResponse);
        echo '<!doctype html><html><head><meta charset="utf-8" /><title>Bambora Online Checkout PHP example</title></head><body>';
        if ($response->meta->result) {
            echo '<script src="https://static.bambora.com/checkout-sdk-web/latest/checkout-sdk-web.min.js"></script>
            <script>
                new Bambora.RedirectCheckout("<?php echo $response->token ?>");
            </script>';
        }else{
            echo '<p>Error: '. $response->meta->message->enduser.'</p>';
        }
        echo '</body></html>';
    }

    public function mailchimp(Request $request){
        try {
            $email = 'azahar1993@gmail.com';
            $list_id = '67e9940438';
            $api_key = '1c34752d9635e8cf9b69882126bffddc-us10';

            $data_center = substr($api_key,strpos($api_key,'-')+1);
            $url = 'https://'. $data_center .'.api.mailchimp.com/3.0/lists/'. $list_id .'/members';
            $json = [
                'email_address' => $email,
                'status'        => 'subscribed', //pass 'subscribed' or 'pending'
            ];

            $response =  Http::withBasicAuth('anystring', $api_key)->post($url, $json);
            if (200 == $response->getStatusCode()) {
                return ['status'=>$response->getStatusCode(),'message'=>"You have successfully subscribed to our newsletter."];
            }else{
                return ['status'=>$response->getStatusCode(),'message'=>"Sorry! You have already subscribed to our newsletter."];
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}



