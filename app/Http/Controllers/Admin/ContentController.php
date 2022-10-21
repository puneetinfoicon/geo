<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Context;
use App\Models\Service;
use App\Models\Footer;

class ContentController extends Controller
{
    public function dynamicPages()
    {
        return view('admin.content.list',['page' => 'home_page']);
    }

    public function editHome($page)
    {
        $result     = getContent1($page);
        $homeVideos = array();


        if ($page == "home_page") {
            $homeVideos = getHomeVideos();
        }

        if($result['success'] == 1){

            return view('admin.content.editHome',['content' => $result['content'],'page' => $page, 'homeVideos' => $homeVideos]);

        }else{

            session()->flash('alert-class', 'success');
            session()->flash('message', $result['message']);
            return redirect("/admin/dynamic-pages");

        }
    }

    public function edit_footer(Request $request)
    {
        $footer = Footer::all();
        return view('admin.content.editFooter',['footer' => $footer]);
    }

    public function update_footer(Request $request)
    {
        $x = 1;
        foreach($request->heading as $key=>$value){
            $id =  $request->id[$key];
            $url =  $request->url[$key];
            $heading =  $request->heading[$key];
            $st = "status".$x++;
            $status = $request->$st;
            Footer::where('id',$id)->update(['heading'=>$heading,'url'=>$url,'status'=>$status]);
        }
        session()->flash('alert-class', 'success');
        session()->flash('message', 'Data has successfully updated');
        return redirect()->back();
    }

    public function updateContent(Request $request){

        $result = contentUpdate($request);
        session()->flash('alert-class', 'success');
        session()->flash('message', $result['message']);
        return redirect('/admin/dynamic-pages');

    }

    // public function editStatic (Request $request, $page)
    // {
    //     $result = getContent1($page);
    //     $url    = str_replace(request()->path(), "", url()->current());
    //     if($result['success'] == 1){

    //         return view('admin.content.editAllContent',['content' => $result['content'], 'page' => $page, 'url' => $url]);

    //     }else{

    //         session()->flash('alert-class', 'success');
    //         session()->flash('message', $result['message']);
    //         return redirect($result['redirect']);

    //     }
    // }

    // public function editStaticContent($page)
    // {
    //     // $result = getContent1($page);
    //     $data = array();
    //     $data['modelName']          = 'App\Models\Content';

    //     $data['where'][0]['key']    = 'id';
    //     $data['where'][0]['value']  = 127;

    //     $data['first']              = 1;

    //     $result = getDataModel($data);
    //     // echo "<pre>"; print_r($result->data); echo "</pre>";  die;
    //     // if($result['success'] == 1){

    //         return view('admin.content.editContent1',['page' => $page, 'content' => $result->data]);

    //     // }
    // }

    // public function editStaticContentOld($page)
    // {
    //     $result = getContent1($page);
    //     $data = array();
    //     $data['modelName']          = 'App\Models\Content';

    //     $data['where'][0]['key']    = 'id';
    //     $data['where'][0]['value']  = 127;

    //     $data['first']              = 1;

    //     $result = getDataModel($data);
    //     // echo "<pre>"; print_r($result->data); echo "</pre>";  die;
    //     if($result['success'] == 1){

    //         return view('admin.content.editContent',['page' => $page, ]);

    //     }
    // }

    public function addTeam()
    {
        $teams = getAllTeamMembers();
        return view('admin.content.addTeam', ['teams' => $teams]);
        // return view('admin.content.editTeam', ['teams' => $teams]);
    }

    public function postTeam(Request $request)
    {
        $response = insertTeam($request);

        session()->flash('alert-class', 'success');
        session()->flash('message', $response['message']);

        return redirect($response['redirect']);
    }

    public function editTeam($id)
    {

        $response = getMemberDetail($id);

        if ($response['success'] == 1) {

            return view('admin.content.editTeam', ['member' => $response['data']]);

        }else{
            session()->flash('alert-class', 'success');
            session()->flash('message', $response['message']);

            return redirect($response['redirect']);

        }

    }public function deleteTeam($id)
{

    $team = Team::where('id', $id)->first();
    $storage = storage_path('app/'. $team->image);
//        removeFile('public/' . $team->image);
//        removeFile($storage);
    $team->delete();
    session()->flash('alert-class', 'success');
    session()->flash('message', "$team->name member  deleted successfully.");
    return redirect("/admin/addTeam");

}

    public function updateTeam(Request $request)
    {
        $response = updateTeamMember($request);
        session()->flash('alert-class', 'success');
        session()->flash('message', $response['message']);

        return redirect($response['redirect']);
    }

    public function editSupport()
    {
        $id                 = 1;
        $service            = Service::where('id', $id)->first();
        $contexts           = Context::get();
        $productContexts = [];
        if (isset($service->contexts)){
            $productContexts    = $service->contexts->pluck('id')->toArray();
        }


        return view('admin.content.editSupport', ['contexts' => $contexts,'productContexts' => $productContexts, 'service' => $service, 'id' => $id]);

    }

    public function updateSupport(Request $request)
    {
        $response = updateSupportData($request);
        session()->flash('alert-class', 'success');
        session()->flash('message', $response['message']);

        return redirect($response['redirect']);
    }

    public function login_reg(Request $request)
    {
        $data['details'] = Content::where('name','login')->orWhere('name','signup')->orWhere('name','signup_footer')->orWhere('name','signup_footerLink')->orWhere('name','signup_footer_contentLink')->get();
        return view('admin.content.login-reg',$data);
    }

    public function update_login_reg(Request $request)
    {
        $login = $request->login;
        $reg = $request->signup;
        $signup_footer = $request->signup_footer;
        $signup_footerLink = $request->signup_footerLink;
        $signup_footer_contentLink = $request->signup_footer_contentLink;
        Content::where('name','login')->update(['data'=>$login]);
        Content::where('name','signup')->update(['data'=>$reg]);
        Content::where('name','signup_footer')->update(['data'=>$signup_footer]);
        Content::where('name','signup_footerLink')->update(['data'=>$signup_footerLink]);
        Content::where('name','signup_footer_contentLink')->update(['data'=>$signup_footer_contentLink]);

        session()->flash('alert-class', 'success');
        session()->flash('message', "Data has been successfully updated.");

        return redirect()->back();
    }

    public function newsletters(Request $request)
    {
        $data['news'] = newsletters();
        return view('admin.content.newsletter',$data);
    }

    public function update_newsletter(Request $request)
    {
        $news = Newsletter::find(1);
        $news->news_heading = $request->news_heading;
        $news->landburg_heading = $request->landburg_heading;
        $news->landmailing_heading = $request->landmailing_heading;
        $news->policy_link = $request->policy_link;
        $news->save();
        return redirect()->back();
    }

    public function kontakat_os_modal()
    {
        $data['details'] =  kontakat_os();
        return view('admin.content.kontakat_os',$data);
    }

    public function update_kontakt_os_modal(Request $request)
    {
        // dd($request->all());
        Content::where('page','kontakt_page')->where('name','header_content')->update(['data'=>$request->header_content]);
        Content::where('page','kontakt_page')->where('name','btn_name')->update(['data'=>$request->btn_name]);
        Content::where('page','kontakt_page')->where('name','kontakt_page_email')->update(['data'=>$request->kontakt_page_email]);
        return redirect()->back();
    }

    public function bliv_ringet_modal(Request $request)
    {
        $data['details'] =  bliv_ringet();
        return view('admin.content.bliv_ringet',$data);
    }

    public function update_bliv_ringet_modal(Request $request)
    {
        // dd($request->all());
        Content::where('page','bliv_ringet')->where('name','content_bliv')->update(['data'=>$request->content_bliv]);
        Content::where('page','bliv_ringet')->where('name','btn_bliv')->update(['data'=>$request->btn_bliv]);
        return redirect()->back();
    }

    public function checkout_terms(Request $request)
    {
       $data['details'] = getAllCheckout_terms();
       return view('admin.content.checkoutTerms',$data);
    }

    public function update_checkout_terms(Request $request){
        // dd($request->all());
        Content::where('page','checkout')->where('name','first_terms_and_conditions')->update(['data'=>$request->first_terms_and_conditions]);
        Content::where('page','checkout')->where('name','first_terms_and_conditions_link')->update(['data'=>$request->first_terms_and_conditions_link]);
        Content::where('page','checkout')->where('name','second_terms_and_conditions')->update(['data'=>$request->second_terms_and_conditions]);
        Content::where('page','checkout')->where('name','second_terms_and_conditions_link')->update(['data'=>$request->second_terms_and_conditions_link]);
        return redirect()->back();
    }

}

// echo "<pre>"; print_r($result); echo "</pre>";  die;
