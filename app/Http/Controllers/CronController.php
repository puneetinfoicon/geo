<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CronController extends Controller
{
    public function refreshProductsAPI()
    {
        $data['url']    = "https://udvnavintegration.le34.dk/Product"; // product API
        $token          = \Session::get('api_token');
//       echo  $token          = env('TOKEN');
        $data['token']  = "Shop $token ";
        $result           = getThirdPartyApi($data);
       $temp = inserUpdateProduct($result['json']);
        //echo "<pre>"; print_r($temp); echo "</pre>";
        echo "<pre>"; print_r($result['json']); echo "</pre>";

    }

    public function refreshOrganizationAPI()
    {
        $data['url']    = "https://udvnavintegration.le34.dk/GPSNetOrganization"; // GPSNetOrganization API
        $token          = env('TOKEN');
        $data['token']  = "Shop $token ";
        $result           = getThirdPartyApi($data);
        inserUpdateOrganisation($result['json']);
        // echo "<pre>"; print_r($result['json']); echo "</pre>";

    }
}
