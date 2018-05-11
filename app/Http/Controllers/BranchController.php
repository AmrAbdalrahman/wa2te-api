<?php
namespace App\Http\Controllers;

use App\branches;
use App\contacts;
use App\Http\Requests\BranchRequest;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    public function index()
    {
        $branches = branches::orderBy('id', 'desc')->get();
        return response()->json($branches);
    }

    public function addBranch(BranchRequest $request)
    {

        /*$singleId = contacts::where('title_en',$request->input('contact_name'))->select('id')->first();*/
        $branch = new branches();
        $branch->title_en = $request->input('title_en');
        $branch->title_ar = $request->input('title_ar');
        $branch->desc_en = $request->input('desc_en');
        $branch->desc_ar = $request->input('desc_ar');
        $branch->address = $request->input('address');
        $branch->phone = $request->input('phone');
        $branch->lat = $request->input('lat');
        $branch->lng = $request->input('lng');
        $branch->img = $request->input('img');
        /*$branch->contact_name = $request->input('contact_name');*/
        $branch->contact_id = $request->input('contact_id');
        $branch->governate_id = $request->input('governate_id');
        $branch->save();
        $response = array('response'=>'branch Added Successfully', 'success'=> true);
        return $response;
    }


    public function editBranch($id)
    {
        $branch = branches::where('id',$id)->get();
        return response()->json($branch);
    }
    public function updateBranch(BranchRequest $request)
    {
        /*$singleId = contacts::where('title_en',$request->input('contact_name'))->select('id')->first();*/
        $id = $request->input('id');
        branches::where('id', '=', $id)->update(array(
            'title_en' => $request->input('title_en'),
            'title_ar' => $request->input('title_ar'),
            'desc_en' => $request->input('desc_en'),
            'desc_ar' => $request->input('desc_ar'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'lat' => $request->input('lat'),
            'lng' => $request->input('lng'),
            'img' => $request->input('img'),
//            'contact_name' => $request->input('contact_name'),
            'contact_id' => $request->input('contact_id'),
            'governate_id' => $request->input('governate_id'),
        ));
        $response = array('response'=>'branch Updated!', 'success'=>true);
        return $response;
    }

    public function destroy($id)
    {
        branches::where('id',$id)->delete();
        $response = array('response'=>'branch deleted!', 'success'=>true);
        return $response;
    }
}
