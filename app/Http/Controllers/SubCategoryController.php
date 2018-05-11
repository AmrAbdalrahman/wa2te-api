<?php
namespace App\Http\Controllers;

use App\categories;
use App\contact_subcategory;
use App\Http\Requests\SubCategoryRequest;
use App\sub_categories;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    public function index()
    {
        $subCategory = sub_categories::orderBy('id', 'desc')->get();
        return response()->json($subCategory);
    }

    public function addSubCategory(SubCategoryRequest $request)
    {
        /*$catId = categories::where('name_en',$request->input('cat_name'))->select('id')->first();*/
        $sub_category = new sub_categories();
        $sub_category->name_en = $request->input('name_en');
        $sub_category->name_ar = $request->input('name_ar');
        $sub_category->img = $request->input('img');
        /*$sub_category->cat_name = $request->input('cat_name');*/
        $sub_category->cat_id = $request->input('cat_id');
        $sub_category->save();

//        if($request->selectedItems){
//            foreach ($request->selectedItems as $item){
//                $code= new contact_subcategory();
//                $code->subcat_id = $sub_category->id;
//                $code->contact_id = $item['id'];
//                $code->save();
//            }
//        }
        $response = array('response'=>'sub_category Added Successfully', 'success'=> true);
        return $response;
    }


    public function editSubCategory($id)
    {
        $sub_category = sub_categories::where('id',$id)->get();
        return response()->json($sub_category);
    }

    public function updateSubCategory(SubCategoryRequest $request)
    {
        /*$catId = categories::where('name_en',$request->input('cat_name'))->select('id')->first();*/
        $id = $request->input('id');
        $code = sub_categories::whereId($id)->first();

       $code->update(array(
            'name_en' => $request->input('name_en'),
            'name_ar' => $request->input('name_ar'),
            'img' => $request->input('img'),
           /*'cat_name' => $request->input('cat_name'),*/
            'cat_id' => $request->input('cat_id'),
        ));

//        if($request->selectedItems){
//
//            $arr = array();
//            foreach ($request->selectedItems as $item){
//                $arr[] = $item['id'];
//            }
//            $code->contacts()->sync(array_values($arr), true);
//        }
//        else{
//            $code->contacts()->detach();
//        }

        $response = array('response'=>'sub_category Updated!', 'success'=>true);
        return $response;
    }

    public function destroy($id)
    {
        sub_categories::where('id',$id)->delete();
        $response = array('response'=>'sub_category deleted!', 'success'=>true);
        return $response;
    }
    public function countSubCategories()
    {
       $countSubCategories =  sub_categories::count();
        return response()->json($countSubCategories);
    }
}
