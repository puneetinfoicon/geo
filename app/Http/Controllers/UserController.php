<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function customerList()
    {
        $customers =  getAllUsersbyRole('customer');
        
        return view('admin.users.list', [ "users" => $customers]);
    }

    public function viewUser($id)
    {
        $user = User::find($id);
        return view('admin.users.info', [ "user" => $user]);
    }

    public function userAdminUpdate($id, $status)
    {
        $user = User::find($id);
        $message = "Status changed sucessfully.";
        $redirect = "/admin/customers/view/$id";

        if($user != null){
            
            if ($status == 1) {

                $user->status = $status;
                $user->save();

            }elseif ($status == 2) {

                $user->status = $status;
                $user->save();

            }else{

                $message = "Status not defined.";

            }
        }else{
            $message = "Undefined user.";
            $redirect = "/admin";
        }
        session()->flash('alert-class', 'success');
        session()->flash('message', $message);

        return redirect($redirect);
    }
}
