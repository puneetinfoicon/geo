<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use App\Models\User;
use Hash;
use App\Models\Role;

class ProfileController extends Controller
{
    public function adminProfile()
    {

        return view('admin.profile', ["user" => Auth::user()]);
    }

    public function adminProfileUpdate(Request $request)
    {
        $result = updateUser(Auth::user(), $request);
        session()->flash('alert-class', 'success');
        session()->flash('message', $result['message']);

        return redirect($result['redirect']);
    }

    public function adminLogout(Request $request)
    {
        \Cookie::queue('myCart', '', 100000);
        $result = userLogout();
        $request->session()->forget(['api_token', 'customer_token']);
        \Session::flush();
        session_destroy();
        session()->flash('alert-class', 'success');
        session()->flash('message', $result['message']);
        return redirect($result['redirect']);
    }


    public function account()
    {
//        try {
            if (empty(\Session::get('api_token'))) {
                \session()->flash('alert-class', 'success');
                \session()->flash('message', "Not authorise to view this page.");
                return redirect()->route('login-register');
            }
//            if (empty(getProductPrice())) {
//                $result = userLogout();
//                return redirect($result['redirect']);
//            }
//            if (isset(getApi('AccountDetails')['message'])) {
//                $result = userLogout();
//                return redirect($result['redirect']);
//            }
            $pDetails = getProductPrice(); // Get user Details by API
            $profileDetails = getApi('AccountDetails'); // API for user details
            $GPSNetUser = getApi('GPSNetUser');  // API for get all gpsNetUsers
            $ServiceItem = getApi('ServiceItem');  // API for get all Udstyr
            $NonGPSNetSubscriptions = getApi('NonGPSNetSubscriptions');  // API for get all NonGPSNetSubscriptions
            $GPSNetSubscriptions = getApi('GPSNetSubscriptions');  // API for get all GPSNetSubscriptions


            if (isset(json_decode($profileDetails)->message)) {
                $data['profileDetails'] = [];
            } else {
                $data['profileDetails'] = json_decode($profileDetails);
            }

            if (isset(json_decode($GPSNetUser)->message)) {
                $data['GPSNetUser'] = [];
            } else {
                $data['GPSNetUser'] = json_decode($GPSNetUser);
            }

            if (isset(json_decode($ServiceItem)->message)) {
                $data['ServiceItem'] = [];
            } else {
                $data['ServiceItem'] = json_decode($ServiceItem);
            }

            if (isset(json_decode($NonGPSNetSubscriptions)->message)) {
                $data['NonGPSNetSubscriptions'] = [];
            } else {
                $data['NonGPSNetSubscriptions'] = json_decode($NonGPSNetSubscriptions);
            }

            if (isset(json_decode($GPSNetSubscriptions)->message)) {
                $data['GPSNetSubscriptions'] = [];
            } else {
                $data['GPSNetSubscriptions'] = json_decode($GPSNetSubscriptions);
            }
//dd($pDetails[1]);
            if (isset($pDetails[1]->FirstName) && $pDetails[1]->FirstName !=''){
                $data['profileDetails']->FirstName = $pDetails[1]->FirstName;
            }


            return view('customers.account', $data);

//        } catch (\Exception $e) {
//            echo $e->getMessage();
//        }
    }

    public function custom_signup(Request $request)
    {
        $name = "Azahar";
        $email = "chaytanya123@email.com";
        $password = "Sunny@000";

        $data = array(
            'name' => 'Azahar',
            'mobile' => '1234567890',
            'email' => 'fih@le34.dk',
            'password' => Hash::make('SuperSafePwd22!'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $customer = Role::where('slug', 'customer')->first();
        $user = User::create($data);
    }

    public function createGPSNetUser(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'email' => 'required|email|max:255',
                'name' => 'required',
                'phoneNumber' => 'required',
            ]);


            if ($validator->fails()) {
                return redirect()->back()->withInput($request->all())->withError($validator->errors()->first());
            }
            $userDetails = getProductPrice();
            $OrganizationShortName = $userDetails[1]->OrganizationShortName;
            $CustomerNo = $userDetails[1]->CustomerNo;
            $array = ['email' => $request->email, 'name' => $request->name, 'phoneNumber' => $request->phoneNumber, 'OrganizationShortName' => $OrganizationShortName, 'address' => 'string', 'zipCode' => 'string', 'city' => 'string', 'webshopAdmin' => true, 'webshopUser' => true];
            $API = postApi('GPSNetUser', $array);
//            echo "<pre>"; print_r(json_decode($response)); die;
            return redirect()->back();


        } catch (\Exception $e) {
            return ['status' => 500, 'message' => $e->getMessage()];
        }
    }

    public function GPSNetUser_Delete(Request $request)
    {
        $userId = $request->userId;
        $API = deleteApi('GPSNetUser/' . $userId);
        //print_r(json_decode($API));
    }

    public function terminateSubscription(Request $request)
    {
        $userId = $request->userId;
        echo $API = deleteApi('NonGPSNetSubscriptions/TerminateSubscription/' . $userId);

    }

    public function GPSNetSubscriptions_update(Request $request)
    {
        $pDetails = getProductPrice();
        if ($pDetails[1]->Dealer == true) {
            $array = ['id' => $request->userId, 'simNo' => $request->simNo, 'customersReference' => $request->customersReference, 'dealersReference' => $request->dealersReference];
        } else {
            $array = ['id' => $request->userId, 'simNo' => $request->simNo, 'customersReference' => $request->customersReference];

        }
        $API = patchApi('GPSNetSubscriptions', $array);
    }

    public function deleteGPSNetSubscriptions(Request $request)
    {
        $array = ['subscriptionId' => $request->subscriptionId];
        if (\Session::get('api_token')) {
            $token = \Session::get('api_token');
            $api_url = env('BASE_API_URL');
            echo $result = Http::withToken($token)->delete($api_url . 'GPSNetSubscriptions/TerminateSubscription', $array);
        }

    }

    public function GPSNetUser_update(Request $request)
    {
        $array = ['userId' => $request->userId, 'email' => $request->email, 'fullname' => $request->fullname, 'phoneNumber' => $request->phoneNumber];
        $API = patchApi('GPSNetUser', $array);
        print_r($API);
    }

    public function passwordUpdate(Request $request)
    {
        echo '<div class="modal kontakt-modal" id="login' . $request->userId . '">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">X</button>
                        </div>
                    <div class="loginmodal-container">
                        <h2>Change Password ' . $request->userId . '</h2><br>
                        <form>
                            <input type="password" class="password' . $request->userId . '" placeholder="Password">
                            <input type="password" class="cpassword' . $request->userId . '" placeholder="Confirm Password">
                            <a class="login loginmodal-submit" onclick="updatePass(' . $request->userId . ')">Save</a>
                            <div class="perror d-none"></div>
                        </form>
                    </div>

                    </div>
                </div>
            </div>
';
    }

    public function updatePass(Request $request)
    {
        $array = ['userId' => $request->userId, 'password' => $request->password];
        $API = postApi('GPSNetLogin/UpdateLoginPassword', $array);
        echo "<pre>";
        print_r(json_decode($API));
        die;
    }

    public function getUserData(Request $request)
    {

        $temp = [];
        $draw = $request->draw;
        $row = $request->start;
        $direction = $request->order[0]['dir'];
        $column = $request->order[0]['column'];
        if ($column == 0) {
            $filter = "number";
        } elseif ($column == 1) {
            $filter = "date";
        } elseif ($column == 2) {
            $filter = "products";
        } elseif ($column == 3) {
            $filter = "filename";
        } elseif ($column == 4) {
            $filter = "amount";
        }
        $search = '';
        if (isset($request->search)) {
            $search = $request->search['value'];
        }
        $rowperpage = $request->length;
        $string = "limit=" . $rowperpage . "&offset=" . $row . '&search=' . $search . '&orderBy=' . $filter . '&orderDirection=' . $direction;

        $API = getApi('Order?' . $string);
        $data = json_decode($API);
        $mydata = $data->listItems;
        $iTotalDisplayRecords = $data->totalCount;

        if (count($mydata) > 0) {
            foreach ($mydata as $value) {
                $arr['Ordrenummer'] = "#" . $value->number;
                $arr['Dato'] = date('Y-m-d h:i:s', strtotime($value->date));
                $arr['Produkt'] = $value->products;
                $route = url('customer/getPdf/' . $value->type . '/' . $value->number . '/' . $value->filename);
                $arr['Ordrebekræftelse'] = "<a href='" . $route . "' target='_blank'>" . $value->filename . "</a>";
                $arr['Beløb'] = str_replace(",", ".", number_format($value->amount));
                array_push($temp, $arr);
            }

        } else {
            $arr['Ordrenummer'] = "";
            $arr['Dato'] = "";
            $arr['Produkt'] = "";
            $arr['Ordrebekræftelse'] = "";
            $arr['Beløb'] = "";
            array_push($temp, $arr);
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => count($mydata),
            "iTotalDisplayRecords" => $iTotalDisplayRecords,
            "aaData" => $temp
        );
        echo json_encode($response);
    }

    public function getPdf(Request $request, $type, $number, $fileName)
    {
        try {
            $filelink = 'https://udvnavintegration.le34.dk/' . $type . '/pdf/' . $number;
            if (\Session::get('api_token')) {
                $token = \Session::get('api_token');
                $result = Http::withToken($token)->get($filelink);
                header("Content-type: application/octet-stream");
                header("Content-Type: application/pdf");
                header("Content-Disposition: inline; filename=$fileName");
                echo $result;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function exportAllOrder(Request $request)
    {
        try {
            if (\Session::get('api_token')) {
                $token = \Session::get('api_token');
                $baseUrl = $api_url = env('BASE_API_URL') . 'Order?limit=10000000';
                $result = Http::withToken($token)->get($baseUrl);
                if ($result->getStatusCode() == 200) {
                    $fileName = "Ordreoversigt -" . date('Y-m-d') . ".xls";
                    // Column names
                    $fields = array('number', 'date', 'products', 'filename', 'filelink', 'amount', 'type');

                    // Display column names as first row
                    $excelData = implode("\t", array_values($fields)) . "\n";

                    $newResult = json_decode($result);
                    //echo "<pre>";
                    foreach ($newResult->listItems as $row) {
                        $lineData = [$row->number, $row->date, $row->products, $row->filename, $row->filelink, $row->amount, $row->type];
                        array_walk($lineData, 'filterData');
                        $excelData .= implode("\t", array_values($lineData)) . "\n";
                    }
                    // Headers for download
                    header("Content-Type: application/vnd.ms-excel");
                    header("Content-Disposition: attachment; filename=\"$fileName\"");
                    // Render excel data
                    echo $excelData;
                }

            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function userAcountUpdate(Request $request)
    {
        try {
            $arr['invoiceemail'] = $request->invoiceemail;
            $arr['address'] = $request->address;
            $arr['postalNo'] = $request->postalNo;
            $arr['city'] = $request->postalCity;
            $arr['password'] = $request->password;
            $arr['passwordConfirmed'] = $request->passwordConfirmed;
            $arr['phoneNumber'] = $request->phoneNumber;
            // $response = patchApi('AccountDetails', $arr);
            if (\Session::get('api_token')) {
                $token = \Session::get('api_token');
            }
            $api_url = env('BASE_API_URL');
            $response = Http::withToken($token)->patch($api_url . 'AccountDetails', $arr);
            if ($response->getStatusCode() == 200) {
                $success = 1;
                $result['message'] = "Profile has been successfully updated";
                \session()->flash('alert-class', 'success');
                \session()->flash('message', "Profile has been successfully updated");
                $result['redirect'] = '/customer/account-page';
                return redirect($result['redirect']);
            } else {
                $success = 1;
                $result['message'] = json_decode($response)->data[0];
                \session()->flash('alert-class', 'success');
                \session()->flash('message', json_decode($response)->data[0]);
                $result['redirect'] = '/customer/account-page';
                return redirect($result['redirect']);
            }


        } catch (\Exception $e) {
            $success = 0;
            $result['message'] = $e->getMessage();
            $result['redirect'] = '/customer/account-page';
            \session()->flash('alert-class', 'success');
            \session()->flash('message', $e->getMessage());
            return redirect($result['redirect']);
        }
    }


}


