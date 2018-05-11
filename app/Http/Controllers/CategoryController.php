<?php

namespace App\Http\Controllers;

use App\categories;
use App\contact_category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $Categorys = categories::orderBy('id', 'desc')->get();

        return response()->json($Categorys);
    }

    public function addCategory(CategoryRequest $request)
    {
        $Category = new categories();
        $Category->name_en = $request->input('name_en');
        $Category->name_ar = $request->input('name_ar');
        $Category->img = $request->input('img');
        $Category->save();

        if($request->selectedItems){
            foreach ($request->selectedItems as $item){
                $code= new contact_category();
                $code->cat_id = $Category->id;
                $code->contact_id = $item['id'];
                $code->save();
            }
        }

        $response = array('response'=>'Category Added Successfully', 'success'=> true);
        return $response;
    }


    public function editCategory($id)
    {
        $categories = categories::where('id',$id)->get();
        foreach ($categories as $object){
            $object->contacts;
        }

        return response()->json($categories);
    }

    public function updateCategory(CategoryRequest $request)
    {
        $id = $request->input('id');
        $code = categories::whereId($id)->first();

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

        $response = array('response'=>'Category Updated!', 'success'=>true);
        return $response;
    }


    public function destroy($id)
    {
        categories::where('id',$id)->delete();
        $response = array('response'=>'Category deleted!', 'success'=>true);
        return $response;
    }
    public function countCategories()
    {
        $countCategories = categories::count();
        return response()->json($countCategories);
    }
}
