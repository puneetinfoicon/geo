<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

class AuthController extends Controller
{
    public function userLogin(Request $request)
    {
        $array = ['loginName' => 'fih@le34.dk', 'password' => 'SuperSafePwd22!', 'organizationShortName' => 'string', 'userId' => 0];
        return $result = postApi('GPSNetLogin', $array);
        // return $response =Http::withToken('tajc00kdX72gmVbJXZXv2XbAqccQNQOlJO6NTXAR')->post('https://udvnavintegration.le34.dk/GPSNetLogin', $array);
    }

    public function submit_login(Request $request)
    {
        try {
            $abc = userAdminLogin($request);
//            echo "<pre>";
//        print_r($abc);
//        die;


            $array = ['loginName' => $request->email, 'password' => $request->password];
            $response = postApi('Authentication/SignIn', $array);
            $json = $response;
            // echo "<pre>";  print_r(json_decode($json)); die;
            if (isset($json->token)) {
                $loginDetails = getUserType($json->token);

                if ($loginDetails[1]->GeoteamAdmin == 'True') {
                    \Session::put('api_token', $json->token);
                    $cookie = \Cookie::get('myCart');
                    if ($cookie != null) {
                        $pDetails = getProductPrice();
                        $customerNo = $pDetails[1]->CustomerNo;
                        $cartDetails = Cart::where('cookieId', $cookie)->first();
                        if (isset($cartDetails->basketId)) {
                            patchApi('Basket/AddCustomerNumber', ['basketId' => $cartDetails->basketId, 'customerNo' => $customerNo]);
                            Cart::where('basketId', $cartDetails->basketId)->update(['customerNo' => $customerNo]);
                        }
                    }
                    $success['success'] = 1;
                    $success['message'] = "User loged in successfully.";
                    $success['redirect'] = "/admin";
                    return redirect($success['redirect']);
                } else {
                    $success = 1;
                    \Session::put('api_token', $json->token);
                    \Session::put('customer_token', $json->token);
                    $cookie = \Cookie::get('myCart');
                    if ($cookie != null) {
                        $pDetails = getProductPrice();
                        $customerNo = $pDetails[1]->CustomerNo;
                        $cartDetails = \DB::table('carts')->where('cookieId', $cookie)->first();
                        if (isset($cartDetails->basketId)) {
                            patchApi('Basket/AddCustomerNumber', ['basketId' => $cartDetails->basketId, 'customerNo' => $customerNo]);
                            Cart::where('basketId', $cartDetails->basketId)->update(['customerNo' => $customerNo]);
                        }
                    }
                    $result['message'] = "User logged in successfully.";
                    $result['redirect'] = '/';
                    return redirect($result['redirect']);
                }
                //echo "<pre>"; print_r($loginDetails); die;
            } else {
                $success = 0;
                $result['message'] = json_decode($json)->message;
                session()->flash('alert-class', 'success');
                session()->flash('message', json_decode($json)->message);
                $result['redirect'] = '/login-register';
                return redirect($result['redirect']);
            }

        } catch (\Exception $e) {
            $success = 0;
            $result['message'] = $e->getMessage();
            $result['redirect'] = '/login-register';
        }
    }

    public function organization_register(Request $request)
    {
        try {
//            echo "<pre>";
//            print_r($request->all());
//            die;
            $result = postApi('Customer', $request->all());
//echo "<pre>";
//print_r(json_decode($result)); die;
            if (isset($result->user)) {
                $user = new User();
                $user->name = $request->fullName;
                $user->email = $request->email;
                $user->mobile = $request->phone;
                $user->pincode = $request->postalNo;
                $user->address = $request->address1 . " " . $request->address2;
                $user->password = bcrypt($request->password);
                if ($user->save()) {
                    session()->flash('alert-class', 'success');
                    session()->flash('message', "Registration has been successfully completed");
                    return redirect('/login-register');
                }
            } else {
                session()->flash('alert-class', 'danger');
                session()->flash('message', json_decode($result)->message);
                return redirect('/login-register')->withInput($request->all());
            }
        } catch (\Exception $e) {
            session()->flash('alert-class', 'danger');
            session()->flash('message', $e->getMessage());
            return redirect('/login-register')->withInput($request->all());
        }
    }


}
