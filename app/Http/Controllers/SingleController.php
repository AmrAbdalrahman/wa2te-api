<?php
namespace App\Http\Controllers;

use App\branches;
use App\contact_subcategory;
use App\contacts;
use App\Http\Requests\SingleRequest;
use App\sub_categories;
use Illuminate\Http\Request;

class SingleController extends Controller
{

    public function index()
    {
        $singls = contacts::orderBy('id', 'desc')->get();
        return response()->json($singls);
    }

    public function addSingle(SingleRequest $request)
    {
        /*$subcatId = sub_categories::where('name_en',$request->input('subcat_name'))->select('id')->first();
        $subid= $subcatId->id;*/

        $single = new contacts();
        $single->title_en = $request->input('title_en');
        $single->title_ar = $request->input('title_ar');
        $single->desc_en = $request->input('desc_en');
        $single->desc_ar = $request->input('desc_ar');
        $single->address_en = $request->input('address_en');
        $single->address_ar = $request->input('address_ar');
        $single->phone = $request->input('phone');
        $single->website = $request->input('website');
        $single->fb = $request->input('fb');
        $single->twitter = $request->input('twitter');
        $single->square_img = $request->input('square_img');
        $single->rect_img = $request->input('rect_img');
        $single->keywords = $request->input('keywords');
        $single->lat = $request->input('lat');
        $single->lon = $request->input('lon');
        /*$single->subcat_name = $request->input('subcat_name');*/
        $single->first_time = $request->input('first_time');
        $single->middle_time = $request->input('middle_time');
        $single->last_time = $request->input('last_time');
        /*$single->subcat_id = $request->input('subcat_id');*/
        $single->save();

             $code= new contact_subcategory();
                $code->subcat_id = $request->input('subcat_id');
                $code->contact_id = $single->id;
                $code->save();

        $response = array('response'=>'single Added Successfully', 'success'=> true);
        return $response;
    }


    public function editSingle($id)
    {
        $single = contacts::where('id',$id)->get();
        return response()->json($single);
    }
    public function updateSingle(SingleRequest $request)
    {
        $subcatId = sub_categories::where('name_en',$request->input('subcat_name'))->select('id')->first();
        $subid= $subcatId->id;

        $id = $request->input('id');
        $code = contacts::whereId($id)->first();
        $code->update(array(
            'title_en' => $request->input('title_en'),
            'title_ar' => $request->input('title_ar'),
            'desc_en' => $request->input('desc_en'),
            'desc_ar' => $request->input('desc_ar'),
            'address_en' => $request->input('address_en'),
            'address_ar' => $request->input('address_ar'),
            'phone' => $request->input('phone'),
            'website' => $request->input('website'),
            'fb' => $request->input('fb'),
            'twitter' => $request->input('twitter'),
            'square_img' => $request->input('square_img'),
            'rect_img' => $request->input('rect_img'),
            'keywords' => $request->input('keywords'),
            'lat' => $request->input('lat'),
            'lon' => $request->input('lon'),
            /*'subcat_name' => $request->input('subcat_name'),*/
            'first_time' => $request->input('first_time'),
            'middle_time' => $request->input('middle_time'),
            'last_time' => $request->input('last_time'),
            /*'subcat_id' => $subid,*/
        ));

        $code->subCategories()->sync([$request->input('subcat_id')]);
        $response = array('response'=>'single Updated!', 'success'=>true);
        return $response;
    }

    public function destroy($id)
    {
        contacts::where('id',$id)->delete();
        $response = array('response'=>'single deleted!', 'success'=>true);
        return $response;
    }
    public function countSingles()
    {
       $countSingles = contacts::count();
        return response()->json($countSingles);
    }
}
