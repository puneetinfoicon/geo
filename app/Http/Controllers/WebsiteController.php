<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use HansSchouten\LaravelPageBuilder\LaravelPageBuilder;
use Illuminate\Support\Facades\Http;

class WebsiteController extends Controller
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

    public function uri()
    {
        try {
            $url = '/' . urldecode(request()->path());
            // dd(($url));
            if(DB::table('pagebuilder__pages')->leftjoin('pagebuilder__page_translations as b', 'b.page_id', '=', 'pagebuilder__pages.id')->where('route', $url)->where('status', '1')->exists()){
                $builder = new LaravelPageBuilder(config('pagebuilder'));
                $hasPageReturned = $builder->handlePublicRequest();

                if (request()->path() === '/' && ! $hasPageReturned) {
                    $builder->getWebsiteManager()->renderWelcomePage();
                }
            }else{
                return response()->view('errors.' . '404', [], 404);
            }
        } catch(\Exception $e){
            return $e->getMessage();
        }

    }
}
