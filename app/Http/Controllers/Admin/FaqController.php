<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faqarea;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Area;

class FaqController extends Controller
{
    public function faqs()
    {
        $categories     = getAllFaqs();
        $areas          = getAllAreas();
        $productAreas   = array();
        $count          = 0;
        if (isset($_GET['page'])) {
            $count = ($_GET['page'] - 1) * 20;
        }
        return view('admin.faqs.add', ['categories' => $categories, 'areas' => $areas, 'productAreas' => $productAreas, 'count' => $count]);
    }

    public function submitFaqs(Request $request)
    {
        $categories = insertFaq($request);
        session()->flash('alert-class', 'success');
        session()->flash('message', $categories['message']);
        return redirect($categories['redirect']);
    }

    public function editFaq($id)
    {
        $produkter = Faq::find($id);
        $productAreas = $produkter->areas->pluck('id')->toArray();
        $areas = getAllAreas();
        return view('admin.faqs.edit', ['produkter' => $produkter, 'productAreas' => $productAreas, 'areas' => $areas,]);
    }

    public function updateFaq(Request $request)
    {
        $categories = updateFaq($request);
        session()->flash('alert-class', 'success');
        session()->flash('message', $categories['message']);
        return redirect($categories['redirect']);
    }

    public function deleteFaq($id)
    {
        $product = Faq::where('id', $id)->delete();
        session()->flash('alert-class', 'success');
        session()->flash('message', "Faq deleted successfully.");
        return redirect("/admin/faqs");
    }

    public function getfaq_Result(Request $request)
    {
        $temp = [];

      if(sizeof(json_decode($request->area))>0){
          foreach (json_decode($request->area) as $area)
          {
              $areaId[] = $area;
          }
      }else{
         $areas  = Area::all();
         foreach ($areas as $areaa){
             $areaId[] = $areaa->id;
         }
      }
//print_r($areaId);

       $ids =   Faqarea::whereIn('area_id',$areaId)->groupBy('faq_id')->get();
        foreach($ids as $aid){
           $data['faqs'] = Faq::where('id',$aid->faq_id)->first()->toArray();
           array_push($temp,$data);
        }
       return $temp;
    }
}
