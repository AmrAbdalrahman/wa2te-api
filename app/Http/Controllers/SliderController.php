<?php
namespace App\Http\Controllers;

use App\contacts;
use App\Http\Requests\SliderRequest;
use App\sliders;
use App\sub_categories;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    public function index()
    {
        $sliders = sliders::orderBy('id', 'desc')->get();
        return response()->json($sliders);
    }

    public function addSlider(SliderRequest $request)
    {

        /*if($request->input('contact_name') == ""){
            $sinid = 0;
        }else{
            $singleId = contacts::where('title_en',$request->input('contact_name'))->select('id')->first();
            $sinid = $singleId->id;
        }


        if($request->input('subcat_name') == ""){
            $subid =0;
        }else{
            $subcatId = sub_categories::where('name_en',$request->input('subcat_name'))->select('id')->first();
            $subid= $subcatId->id;

        }*/
        $slider = new sliders();
        $slider->title_en = $request->input('title_en');
        $slider->title_ar = $request->input('title_ar');
        $slider->desc_en = $request->input('desc_en');
        $slider->desc_ar = $request->input('desc_ar');
        $slider->img = $request->input('img');
        $slider->end_date = $request->input('end_date');
        /*$slider->contact_name = $request->input('contact_name');*/
        $slider->contact_id = $request->input('contact_id');
        /*$slider->subcat_name = $request->input('subcat_name');*/
        $slider->subcat_id = $request->input('subcat_id');
        $slider->save();
        $response = array('response'=>'slider Added Successfully', 'success'=> true);
        return $response;
    }


    public function editSlider($id)
    {
        $slider = sliders::where('id',$id)->get();
        return response()->json($slider);
    }
    public function updateSlider(SliderRequest $request)
    {
        /*if($request->input('contact_name') == ""){
            $sinid = 0;
        }else{
            $singleId = contacts::where('title_en',$request->input('contact_name'))->select('id')->first();
            $sinid = $singleId->id;
        }


        if($request->input('subcat_name') == ""){
            $subid =0;
        }else{
            $subcatId = sub_categories::where('name_en',$request->input('subcat_name'))->select('id')->first();
            $subid= $subcatId->id;

        }*/


        $id = $request->input('id');
        sliders::where('id', '=', $id)->update(array(
            'title_en' => $request->input('title_en'),
            'title_ar' => $request->input('title_ar'),
            'desc_en' => $request->input('desc_en'),
            'desc_ar' => $request->input('desc_ar'),
            'img' => $request->input('img'),
            'end_date' => $request->input('end_date'),
            /*'contact_name' => $request->input('contact_name'),*/
            'contact_id' => $request->input('contact_id'),
            /*'subcat_name' => $request->input('subcat_name'),*/
            'subcat_id' => $request->input('subcat_id'),
        ));
        $response = array('response'=>'slider Updated!', 'success'=>true);
        return $response;
    }

    public function destroy($id)
    {
        sliders::where('id',$id)->delete();
        $response = array('response'=>'slider deleted!', 'success'=>true);
        return $response;
    }
}
