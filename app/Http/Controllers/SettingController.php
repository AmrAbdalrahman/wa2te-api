<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteSettingsRequest;
use App\settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index()
    {
        $settings = settings::first();

        return response()->json($settings);
    }

    public function updateSettings(SiteSettingsRequest $request)
    {

        /*$validator = \Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'address' => 'required',
            'phone' => 'required|numeric',
            'lat' => 'required|numeric|max:50',
            'lng' => 'required|numeric|max:50',
            'fb' => 'required',
            'twitter' => 'required',
            'instgram' => 'required',
            'linkedin' => 'required',
            'keywords' => 'required',
            'vision_en' => 'required',
            'vision_ar' => 'required',
            'mission_en' => 'required',
            'mission_ar' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['data' => $validator->errors()], 400);
        }
        else{*/
            $id = $request->input('id');
            settings::where('id', '=', $id)->update(array(
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'lat' => $request->input('lat'),
                'lng' => $request->input('lng'),
                'email' => $request->input('email'),
                'fb' => $request->input('fb'),
                'twitter' => $request->input('twitter'),
                'instgram' => $request->input('instgram'),
                'linkedin' => $request->input('linkedin'),
                'keywords' => $request->input('keywords'),
                'vision_en' => $request->input('vision_en'),
                'vision_ar' => $request->input('vision_ar'),
                'mission_en' => $request->input('mission_en'),
                'mission_ar' => $request->input('mission_ar'),
            ));

            $response = array('response'=>'Settings Updated!', 'success'=>true);
            return $response;
            /*}*/


    }


}
