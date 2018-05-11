<?php

namespace App\Http\Controllers;

use App\contact_governate;
use App\governates;
use App\Http\Requests\GovernmentRequest;
use Illuminate\Http\Request;

class GovernmentController extends Controller
{

    public function index()
    {
        $governments = governates::orderBy('id', 'desc')->get();

        return response()->json($governments);
    }

    public function addGovernment(GovernmentRequest $request)
    {
        $government = new governates();
        $government->name_en = $request->input('name_en');
        $government->name_ar = $request->input('name_ar');
        $government->img = $request->input('img');
        $government->save();

        if($request->selectedItems){
            foreach ($request->selectedItems as $item){
                $code= new contact_governate();
                $code->governate_id = $government->id;
                $code->contact_id = $item['id'];
                $code->save();
            }
        }

        $response = array('response'=>'government Added Successfully', 'success'=> true);
        return $response;
    }

    public function editGovernment($id)
    {
        $government = governates::where('id',$id)->get();
        foreach ($government as $object){
            $object->contacts;
        }

        return response()->json($government);
    }

    public function updateGovernment(GovernmentRequest $request)
    {
        $id = $request->input('id');
        $code = governates::whereId($id)->first();

        $code->update(array(
            'name_en' => $request->input('name_en'),
            'name_ar' => $request->input('name_ar'),
            'img' => $request->input('img')
        ));

        if($request->selectedItems){

            $arr = array();
            foreach ($request->selectedItems as $item){
                $arr[] = $item['id'];
            }
            $code->contacts()->sync(array_values($arr), true);
        }
        else{
            $code->contacts()->detach();
        }

        $response = array('response'=>'Government Updated!', 'success'=>true);
        return $response;
    }


    public function destroy($id)
    {
        governates::where('id',$id)->delete();

        $response = array('response'=>'Government deleted!', 'success'=>true);
        return $response;
    }
}
