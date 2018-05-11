<?php

namespace App\Http\Controllers;

use App\Advertise;
use App\categories;
use App\contacts;
use App\governates;
use App\Http\Requests\Contact;
use App\settings;
use App\sliders;
use App\sub_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\incorrectdata;


class HomeController extends Controller
{

    //get site setting
    public function getSiteSettings(){

        $settings = settings::orderBy('id', 'desc')->get();

        return response()->json($settings);
    }

    //get all governments

    public function getAllGovernments(){

        $governments = governates::orderBy('id', 'desc')->get();

        return response()->json($governments);
    }

    //get all sliders

    public function getSlidersSubCat(){

        $sliders = sliders::where('contact_id',1)->orderBy('id', 'Asc')->get();

        return response()->json($sliders);
    }


    // get all categories
    public function getAllCategories(){
        $categories = categories::has('subCategories')->get();

        foreach ($categories as $cat){
            $cat->subCategories;
        }

        return response()->json($categories);
    }


    // get subCategories and its contacts
    public function getSubCategory($id){
        $currentDate = Carbon::now();
        $subCategory = sub_categories::find($id);

        $subCategory->contacts;

        $subCategory->sliders;

        return response()->json(array('subCat'=>$subCategory));
    }


    // get contact data and its branches
    public function getContact($id){

        $currentDate = Carbon::now();
        $weekMap = [ 0 => 'SUNDAY',1 => 'MONDAY',2 => 'TUESDAY',3 => 'WEDNESDAY',4 => 'THURSDAY',5 => 'FRIDAY',6 => 'SATURDAY',];
        $dayOfTheWeek = Carbon::now()->dayOfWeek;
        $weekday = $weekMap[$dayOfTheWeek];
        $contact = contacts::find($id);
        $contact->branches;
        $contact->sliders;
        if($weekday != ($weekMap[5] || $weekMap[6])){
            $workTimes = $contact->middle_time;
        }elseif ($weekday == $weekMap[5]){
            $workTimes = $contact->last_time;
        }else{
            $workTimes = $contact->first_time;
        }
        //$workTimes = $contact->workTimes()->where('DAY_TEXT',$weekday)->get();
        $subCat = $contact->subCategories()->first();
        $nameSub = $subCat->name;
        $related = $subCat->contacts()->limit(4)->get();

        //$subCat = $contact->subCategories->limit(4)->get();
        return response()->json(array('contact' => $contact,'date'=>$workTimes,'related'=>$related,'nameSub'=>$subCat));
    }


    public function addContact(Contact $request){
        $contact = new Advertise();
        $contact->name = $request->input('fullname');
        $contact->email = $request->input('email');
        $contact->type = $request->input('category');
        $contact->phone = $request->input('phone');
        $contact->desc = $request->input('desc');
        $contact->save();
        $response = array('response'=>'Contact ADDED', 'success'=> true);
        return $response;
    }

    public function addInvalidData(Request $request){
        $incorrectdata = new incorrectdata();

        if(($request->singleHours && $request->singlephone) == true){
            $incorrectdata->incorrectFileds = 'Working Hours,Phone';
        }
        elseif (($request->singleHours == true) && ($request->singlephone == false) ){
            $incorrectdata->incorrectFileds = 'Working Hours';
        }
        elseif (($request->singleHours == false) && ($request->singlephone == true) ){
            $incorrectdata->incorrectFileds = 'Phone';
        }else{
            $incorrectdata->incorrectFileds = '';
        }

        $incorrectdata->contact_id = $request->input('contact_id');
        $incorrectdata->user_email = $request->input('user_email');
        $incorrectdata->user_phone = $request->input('user_phone');
        $incorrectdata->save();
        $response = array('response'=>'Contact ADDED', 'success'=> true);
        return $response;
    }

    public function search($name,$gov){
        if($gov == 0){
            $contacts = contacts::where('keywords','LIKE','%'.$name.'%')->get();

            if(!empty($contacts->toArray())){
                $nameSub = '';
                foreach ($contacts as $cat){
                    $nameSub =  $cat->subCategories;
                }
                return response()->json(array('contacts'=>$contacts ,'namesub'=>$nameSub) );
            }else{
                return response()->json('no data' );

            }
        }else{

            $contacts = contacts::has('governements')->where('keywords','LIKE','%'.$name.'%')->get();
            $specials ='';
            /*$specials = contacts::with('governements')
                ->whereHas('governements',  function($query)  {

                    $query->whereNested(function ($query) {

                        $query
                            ->where('governate_id', 6);

                    });
                })->where('keywords','LIKE','%'.$name.'%')->get();*/
            /*$contacts->governementSearch;*/

            if(!empty($contacts->toArray())){
                $nameSub = '';
                $asd= '';
                foreach ($contacts as $cat){
                    $nameSub =  $cat->subCategories;
                    $cat->governements;
                    //$asd= $cat->governementSearch($gov);
                }
                return response()->json(array('contacts'=>$contacts ,'namesub'=>$nameSub,'asd'=>$specials) );
            }else{
                return response()->json('no data' );

            }
        }


    }

    public function contactTerm(){
        $contacts = contacts::select('keywords')->get();

        $arr = array();
        $i=0;
        foreach ($contacts as $cat){

            $arr[$i] = explode(" ,", $cat->keywords);
            $i++;
        }

        $result = array();

        foreach($arr as $item) {
            $result = array_merge($result, $item);
        }

//        $pieces = array();
//
//        foreach($result as $item) {
//            $pieces = explode(",", $item);
//        }
        $dd = implode(" ",$result);


//        // Example 1
//        $pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";
//        $pieces = explode(" ", $pizza);
//        echo $pieces[0]; // piece1
//        echo $pieces[1]; // piece2

        return response()->json(array($dd));

    }

    public function allKeywords(){
        $contacts = contacts::select('keywords')->get();

        if(!empty($contacts->toArray())){
            $nameSub = '';
            foreach ($contacts as $cat){
                $nameSub =  $cat->subCategories;
            }
            return response()->json(array('contacts'=>$contacts ,'namesub'=>$nameSub) );
        }else{
            return response()->json('no data' );

        }

    }



}
