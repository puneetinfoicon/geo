<?php

namespace App\Http\Controllers;

use App\Models\Seotbl;
use Illuminate\Http\Request;
use Redirect, Session;
use Exception;

class SeoController extends Controller
{
    public function manage_seo(Request $request)
    {
        $data['files'] = \DB::table('seo_tbl')->first();
        $data['pages'] = \DB::table('seo_pages')->get();
        return view('admin.seo.index',$data);
    }

    public function update_seoTbl(Request $request)
    {
        $seoTbl = Seotbl::find(1);
        if ($request->file('sitemap') != null) {
            $uploadedFile = $request->file('sitemap');
            $sitemap = $uploadedFile->getClientOriginalName();
            $path = public_path();
//            $newPath = explode('public', $path);
//            $filePath = $newPath[0];
            $uploadedFile->move($path . '/', $sitemap);
            $seoTbl->sitemap = $sitemap;
        }

        if ($request->file('robots') != null) {
            $uploadedFile = $request->file('robots');
            $robots = $uploadedFile->getClientOriginalName();
            $path = public_path();
//            $newPath = explode('public', $path);
//            $filePath = $newPath[0];
            $uploadedFile->move($path . '/', $robots);
            $seoTbl->robots = $robots;
        }
        $seoTbl->google_analytics = $request->google_analytics;
        $seoTbl->save();
        return redirect('admin/manage_seo');

       // print_r($filename);
    }

    public function update_seoPage(Request $request)
    {
       \DB::table('seo_pages')->where('id',$request->id)->update(['title'=>$request->title,'keyword'=>$request->keyword,'description'=>$request->description]);
        return redirect('admin/manage_seo');
    }
}
