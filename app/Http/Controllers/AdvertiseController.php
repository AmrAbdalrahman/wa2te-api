<?php
namespace App\Http\Controllers;

use App\Advertise;
use Illuminate\Http\Request;

class AdvertiseController extends Controller
{

    public function index()
    {
        $advertises= Advertise::orderBy('id', 'desc')->get();
        return response()->json($advertises);
    }


    public function editAdvertise($id)
    {
        $advertise = Advertise::find($id);
        $advertise->fill(['view' => 1])->save();
        return response()->json(array($advertise));
    }
    public function updateAdvertise(Request $request)
    {
        $id = $request->input('id');
        Advertise::where('id', '=', $id)->update(array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'desc' => $request->input('desc'),
            'type' => $request->input('type'),
        ));
        $response = array('response'=>'Message Updated!', 'success'=>true);
        return $response;
    }

    public function destroy($id)
    {
        Advertise::where('id',$id)->delete();
        $response = array('response'=>'Message deleted!', 'success'=>true);
        return $response;
    }

    public function countAdvertise(){
        $countMessages = Advertise::count();
        return response()->json($countMessages);
    }
}
