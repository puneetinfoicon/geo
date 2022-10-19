<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Category;
use App\Models\Context;
use App\Models\SearchCategory;
use App\Models\StaticContent;
use Illuminate\Http\Request;
use DB;


class PageBuilderController extends Controller
{
    public function build($pageId = null)
    {
        $route = $_GET['route'] ?? null;
        $action = $_GET['action'] ?? null;
        $pageId = is_numeric($pageId) ? $pageId : ($_GET['page'] ?? null);
        $pageRepository = new \PHPageBuilder\Repositories\PageRepository;
        $page = $pageRepository->findWithId($pageId);

        $phpPageBuilder = app()->make('phpPageBuilder');
        $pageBuilder = $phpPageBuilder->getPageBuilder();

        $customScripts = view("pagebuilder.scripts")->render();
        $pageBuilder->customScripts('head', $customScripts);

        $pageBuilder->handleRequest($route, $action, $page);
    }

    public function list()
    {
        $list = DB::table('pagebuilder__pages')->leftjoin('pagebuilder__page_translations as b', 'b.page_id', '=', 'pagebuilder__pages.id')->select('pagebuilder__pages.id', 'pagebuilder__pages.name', 'pagebuilder__pages.status', 'b.title', 'b.route', 'b.page_id')->get();
        return view('pagebuilder.allPages', ['list' => $list]);
    }

    public function add()
    {
        $list = array();
        $areaId = array();
        $categoryId = array();
        $searchcategoryId = array();
        $StaticContent = array();


        $categories = Category::get();
        $searchCategories = SearchCategory::get();
       // $context =  Context::select('id','parent_id','name','type')->where('type','page')->orwhere('type','guide')->get();
       // $context =  DB::select(DB::raw("SELECT parent_id, id, name  FROM pagebuilder__pages WHERE  (parent_id IS NULL || parent_id='0') AND  guide='1'"));
        $context =  DB::select(DB::raw("SELECT A.id AS page_id, B.* FROM pagebuilder__pages A, pagebuilder__pages B WHERE (B.id = B.parent_id || B.parent_id IS NULL) AND B.status = '1' AND B.guide = '1' GROUP BY B.id"));

        $areas = Area::get();
        if (isset($_GET['id'])) {
            $areaId = DB::table('static_area')->select('area_id')->where('page_id',$_GET['id'])->get();
            $categoryId = DB::table('static_category')->select('category_id')->where('page_id',$_GET['id'])->get();
            $searchcategoryId = DB::table('static_search_category')->select('search_category_id')->where('page_id',$_GET['id'])->get();
            $StaticContent = DB::select(DB::raw("SELECT parent_id, id, name  FROM pagebuilder__pages WHERE   guide='1' AND id='".$_GET['id']."'"));
               // StaticContent::select('context_id','area_id')->where('page_id',$_GET['id'])->get();
            $list = DB::table('pagebuilder__pages')->where('pagebuilder__pages.id', $_GET['id'])->leftjoin('pagebuilder__page_translations as b', 'b.page_id', '=', 'pagebuilder__pages.id')->select('b.meta_keyword','b.meta_description','pagebuilder__pages.parent_id','pagebuilder__pages.static_content','pagebuilder__pages.id','pagebuilder__pages.guide', 'pagebuilder__pages.name', 'pagebuilder__pages.status', 'b.title', 'b.route')->first();
        }

        return view('pagebuilder.addPage', ['StaticContent' => $StaticContent,'contexts' => $context,'searchcategoryId' => $searchcategoryId,'categoryId' => $categoryId,'areaId' => $areaId,'list' => $list, 'areas' => $areas, 'searchCategories' => $searchCategories, 'categories' => $categories,]);
    }

    public function add_pages(Request $request)
    {
//        echo "<pre>";
//        print_r($request->all());
//        die;
       // try{
            $status = '0';
            if (isset($request->status)) {
                $status = '1';
            }


            $guide = $request->guide;
            if ($guide ==1){
                $route =  "/service-support".$request->prefix.$request->route;
            }else{
                $route = $request->route;
            }

//dd($request['categories']);
            if (isset($request['id'])) {

                DB::table('pagebuilder__pages')->where('id', $request->id)->update(array('name' => $request->name, 'status' => $status, 'guide' => $guide,'static_content' => $request->static_content));
                DB::table('pagebuilder__page_translations')->where('page_id', $request->id)->update( array('title' => $request->title, 'route' =>$route,'meta_keyword'=>$request->meta_keyword,'meta_description'=>$request->meta_description));

                if (isset($request['areas']) || $request['areas'] != null) {
                    DB::table('static_area')->where('page_id',$request->id)->delete();
                    if (isset($request['areas']) && sizeof($request['areas'])>0)
                        $contextId = $request->context_id;
                    if ($request['context_id'] == 0){
                        $contextId = $request->id;
                    }
                        foreach ($request['areas'] as $a=>$area) {
                            DB::table('static_area')->insert(['page_id' => $request->id, 'area_id' => $request['areas'][$a], 'context_id' => $contextId]);
                        }
                }

                if (isset($request['categories']) || empty($request['categories'])) {
                    DB::table('static_category')->where('page_id',$request->id)->delete();
                    if (isset($request['categories']) && sizeof($request['categories'])>0)
                        $contextId = $request->context_id;
                    if ($request['context_id'] == 0){
                        $contextId = $request->id;
                    }
//                    dd($request['categories']);
                        foreach ($request['categories'] as $b=>$category) {
                            DB::table('static_category')->insert(['page_id' => $request->id, 'category_id' => $request['categories'][$b], 'context_id' =>$contextId]);
                        }
                }

                if (isset($request['searchCategories'])|| $request['searchCategories'] != null) {
                    DB::table('static_search_category')->where('page_id',$request->id)->delete();
                    if (isset($request['searchCategories']) && sizeof($request['searchCategories'])>0)
                        $contextId = $request->context_id;
                    if ($request['context_id'] == 0){
                        $contextId = $request->id;
                    }
                        foreach ($request['searchCategories'] as $c=>$searchCategory) {
                            DB::table('static_search_category')->insert(['page_id' => $request->id, 'search_category_id' => $request['searchCategories'][$c], 'context_id' =>$contextId]);
                        }
                }
                if (isset($request['context_id']) AND $request['context_id'] != null) {

                    $contextId = $request->context_id;
                    if ($request['context_id'] == 0){
                        $contextId = $request->id;
                    }
                         DB::table('pagebuilder__pages')->where('id', $request->id)->update(array('parent_id' => $contextId));
                        StaticContent::updateOrCreate(['page_id'=>$request->id],['page_id'=>$request->id,'context_id'=>$contextId,'updated_at'=>now(),'created_at'=>now()]);
                }

                $message = "Page successfully updated.";

            } else {


                $id = DB::table('pagebuilder__pages')->insertGetId(
                    array('name' => $request->name, 'layout' => 'master', 'status' => $status, 'guide' => $guide,'static_content' => $request->static_content)
                );

                DB::table('pagebuilder__page_translations')->insertGetId(
                    array('page_id' => $id, 'locale' => 'en', 'title' => $request->title, 'route' => $route,'meta_keyword'=>$request->meta_keyword,'meta_description'=>$request->meta_description)
                );

                if (isset($request['context_id']) AND $request['context_id'] != null) {

                        $contextId = $request->context_id;
                        if ($request['context_id'] == 0){
                            $contextId = $id;
                        }
                    DB::table('pagebuilder__pages')->where('id', $id)->update(array('parent_id' => $contextId));
                        StaticContent::updateOrCreate(['page_id'=>$id],['page_id'=>$id,'context_id'=>$contextId,'updated_at'=>now(),'created_at'=>now()]);
                }

                if (isset($request['areas']) AND $request['areas'] != null) {
                    if (isset($request['areas']) && sizeof($request['areas'])>0)
                        $contextId = $request->context_id;
                    if ($request['context_id'] == 0){
                        $contextId = $id;
                    }
                        foreach ($request['areas'] as $d=>$area) {
                            DB::table('static_area')->insert(['page_id' => $id, 'area_id' => $request['areas'][$d], 'context_id' => $contextId]);
                        }
                }

                if (isset($request['categories']) || empty($request['categories'])) {
                    if (isset($request['categories']) && sizeof($request['categories'])>0)
                        $contextId = $request->context_id;
                    if ($request['context_id'] == 0){
                        $contextId = $id;
                    }
                        foreach ($request['categories'] as $e=>$category) {
                            DB::table('static_category')->insert(['page_id' => $id, 'category_id' => $request['categories'][$e], 'context_id' => $contextId]);
                        }
                }

                if (isset($request['searchCategories'])|| $request['searchCategories'] != null) {
                    if (isset($request['searchCategories']) && sizeof($request['searchCategories'])>0)
                        $contextId = $request->context_id;
                    if ($request['context_id'] == 0){
                        $contextId = $id;
                    }
                        foreach ($request['searchCategories'] as $f=>$searchCategory) {
                            DB::table('static_search_category')->insert(['page_id' => $id, 'search_category_id' => $request['searchCategories'][$f], 'context_id' => $contextId]);
                        }
                }

                $message = "Page successfully added.";
            }

            session()->flash('alert-class', 'success');
            session()->flash('message', $message);

            return redirect('/admin/pages');
//        }catch (\Exception $e){
//            session()->flash('alert-class', 'message');
//            session()->flash('message', $e->getMessage());
//
//            return redirect('/admin/pages');
//        }

    }

    public function delete_page($id)
    {
        DB::table('pagebuilder__pages')->where('pagebuilder__pages.id', $id)->delete();
        DB::table('pagebuilder__page_translations')->where('pagebuilder__page_translations.page_id', $id)->delete();

        DB::table('static_area')->where('page_id',$id)->delete();
        DB::table('static_category')->where('page_id',$id)->delete();
        DB::table('static_search_category')->where('page_id',$id)->delete();
        DB::table('static_contents')->where('page_id',$id)->delete();
        session()->flash('alert-class', 'success');
        session()->flash('message', "Page deleted successfully.");

        return redirect("/admin/pages");
    }

    public function copy($id)
    {
        duplicatePage($id);
        $message = "Page successfully duplicated.";
        session()->flash('alert-class', 'success');
        session()->flash('message', $message);

        return redirect('/admin/pages');
    }
}
