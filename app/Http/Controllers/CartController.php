<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

use Symfony\Component\HttpFoundation\Cookie;

class CartController extends Controller
{
    public function cart(Request $request)
    {
        $data['menus'] = Menu::where('status', 1)->get();
        return view('cart.cart', $data);
    }

    public function add(Request $request)
    {
        return $result = updataCart($request->api_id, $request->qty);
    }

    public function shareCart($token)
    {
        $result = updateShareCartCookie($token);
        session()->flash('alert-class', 'success');
        session()->flash('message', $result['message']);
        return redirect($result['redirect']);
    }

    public function generateLink(Request $request)
    {
        return $result = shareCart();
    }

    public function sendLink(Request $request)
    {
        //try {
        $email = "sunnyazahar@gmail.com";
//            $email = $request->email;
        $name = "";
        $phone = '';
        $message = " <a href='$request->url' target='_blank'>Please click here to go cart details.</a>";
        $subject = "Geoteam cart details.";
        if (sendMail($name, $email, $phone, $message, $subject) == '') {
            return ['status' => true, 'message' => 'Email has been successfully send.'];
        } else {
            return ['status' => false, 'message' => 'Sorry! Please try after some time'];
        }
//        } catch (\Exception $e) {
//            return ['status' => false, 'message' => $e->getMessage()];
//        }
    }

    public function checkout(Request $request)
    {
        $CustomerNo = '';
        if (\Session::get('api_token')) {
            $pDetails = getProductPrice();
            $CustomerNo = $pDetails[1]->CustomerNo;
        }
        $response = getApi('DeliveryAddress?customerNo=' . $CustomerNo);
        if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
            $data ['addresses'] = json_decode($response);
        } else {
            return redirect('/login-register');
        }
        return view('cart.checkout', $data);
    }

    public function address_save(Request $request)
    {
        try {
            $data = getProductPrice();
            $inputs = $request->all();
            $inputs['customerNo'] = $data[1]->CustomerNo;

            $result = postApi('DeliveryAddress', $inputs);
            if ($result) {
                return redirect()->back()->withSuccess("Address has been successfully added.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->all())->withMessage($e->getMessage());
        }
    }

    public function check_payment_method(Request $request)
    {
        try {
            $orderId = "OD000" . random_int(111111111, 999999999);
            if (!empty($request->eanVal)) {

            } else {
                $session = ['Ordrereference' => $request->Ordrereference, 'details' => $request->details, 'orderId' => $orderId, 'amount' => $request->amount];
                Session()->put('sessionData', $session);
                return redirect('/bambora-payment');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withMessage($e->getMessage());
        }
    }

    public function bambora_payment()
    {
        return view('payments.bambora');
    }

    public function cart_add(Request $request)
    {
        $api_url = env('BASE_API_URL');
        $token = \Session::get('api_token');
        $cookie = \Cookie::get('myCart');
        $product = Product::where('api_id', $request->api_id)->first();
        $array = ['productType' => $product->type, 'productNumber' => $request->api_id, 'description' => $product->short_text, 'quantity' => $request->qty, 'unitPrice' => $request->unitPrice, 'sellPrice' => $request->sellPrice, 'vendorItemNo' => ''];
        if (!empty($cookie)) {
            $basketId = Cart::where('cookieId', $cookie)->first();
            $url = "Basket/" . $basketId->basketId . "/AddProduct";
            if (\Session::get('api_token')) {
                $response = \Http::withToken($token)->post($api_url . $url, $array);
            } else {
                $response = \Http::post($api_url . $url, $array);
            }
            echo $response->getStatusCode();

        } else {
            $cookieId = \Str::random(30);
            \Cookie::queue('myCart', $cookieId, 100000);
            $result = postApi('Basket/GetBasket', ['cookieId' => $cookieId]);
            $cart = new Cart();
            $cart->cookieId = $cookieId;
            $cart->basketId = $result->basketId;
            if ($cart->save()) {
                $url = "Basket/" . $result->basketId . "/AddProduct";
                if (\Session::get('api_token')) {
                    $response = \Http::withToken($token)->post($api_url . $url, $array);
                } else {
                    $response = \Http::post($api_url . $url, $array);

                }
                echo $response->getStatusCode();
            }
        }
    }

    public function cart_add_subscription(Request $request)
    {
        $cookie = \Cookie::get('myCart');
        if ($cookie == null) {
            $cookieId = \Str::random(30);
            \Cookie::queue('myCart', $cookieId, 100000);
            $cc = \Cookie::get('myCart');
            $cookie = $cookieId;
            $result = postApi('Basket/GetBasket', ['cookieId' => $cookie]);
            $cart = new Cart();
            $cart->cookieId = $cookie;
            $cart->basketId = $result->basketId;
            $cart->save();
        } else {
            $cookie = \Cookie::get('myCart');
        }
        return getProductByapi_id($request->all(), $cookie);
    }

    public function removeItem(Request $request)
    {
        //dd($request->all());
        $api_url = env('BASE_API_URL') . 'Basket/Line';
        $token = \Session::get('api_token');
        if (\Session::get('api_token')) {
            $response = \Http::withToken($token)->delete($api_url, ['basketId' => $request->basketId, 'lineId' => $request->api_id]);
        } else {
            $response = \Http::delete($api_url, ['basketId' => $request->basketId, 'lineId' => $request->api_id]);
        }
        echo $response->getStatusCode();
    }

    public function alter_quantity(Request $request)
    {
        //dd($request->all());
        $api_url = env('BASE_API_URL') . 'Basket/Line/Quantity';
        $token = \Session::get('api_token');
        if (\Session::get('api_token')) {
            $response = \Http::withToken($token)->patch($api_url, ['basketId' => $request->basketId, 'lineId' => $request->api_id, 'quantity' => $request->qty]);
        } else {
            $response = \Http::patch($api_url, ['basketId' => $request->basketId, 'lineId' => $request->api_id, 'quantity' => $request->qty]);
        }
        echo $response->getStatusCode();
    }

}
