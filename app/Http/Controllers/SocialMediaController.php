<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialMedia;
use App\Models\Area;
use Session;

class SocialMediaController extends Controller
{
    function index()
    {
        $data['SocialMedias'] = SocialMedia::with('areas')->get();
        $data['areas'] = Area::all();
        $data['default'] = \DB::table('default_social')->first();
        return view('admin.socialMedia.social-media', $data);
    }

    public function insert(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'area' => 'required|unique:social_media,area_id',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withMessage($validator->errors()->first())->withInput($request->input());
            }
            $SocialMedia = new SocialMedia;
            $SocialMedia->area_id = $request->area;
            $SocialMedia->facebook = $request->facebook;
            $SocialMedia->youtube = $request->youtube;
            $SocialMedia->linkedin = $request->linkedin;
            if ($SocialMedia->save()) {
                return redirect()->back()->withMessage("Data has been successfully inserted!");
            }

        } catch (\Exception $e) {
            return redirect()->back()->withMessage($e->getMessage())->withInput($request->input());
        }
    }

    public function edit(Request $request, $id)
    {
        if ($id == 0){
            $data['default'] = \DB::table('default_social')->first();

        }else{
            $data['default'] = SocialMedia::where('id',$id)->first();
        }
        $data['SocialMedias'] = SocialMedia::with('areas')->get();
        $data['areas'] = Area::all();
//        echo "<pre>";
//        print_r($data['default']);
//        echo "</pre>";
//        die;
        return view('admin.socialMedia.social-media-edit', $data);
    }

    public function update(Request $request, $id){
        try {
            $validator = \Validator::make($request->all(), [
                //'area' => 'required|unique:social_media,area_id',
                'area' => 'required|unique:social_media,area_id,' . $id,
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withMessage($validator->errors()->first())->withInput($request->input());
            }

            if ($id != 0){
                $SocialMedia = SocialMedia::find($id) ;
                $SocialMedia->area_id = $request->area;
                $SocialMedia->facebook = $request->facebook;
                $SocialMedia->youtube = $request->youtube;
                $SocialMedia->linkedin = $request->linkedin;
                if ($SocialMedia->save()) {
                    return redirect('/admin/social-media')->withMessage("Data has been successfully Updated!");
                }
            }else{
                 \DB::table('default_social')->update(['facebook'=>$request->facebook,'youtube'=>$request->youtube,'linkedin'=>$request->linkedin]);
                    return redirect('/admin/social-media')->withMessage("Data has been successfully Updated!");
            }
        }catch(\Exception $e){
            return redirect()->back()->withMessage($e->getMessage())->withInput($request->input());
        }
    }
}
