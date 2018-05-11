<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*admit root*/

//government
Route::get('/government','GovernmentController@index');
Route::post('/addGovernment','GovernmentController@addGovernment');
Route::get('/editGovernment/{id?}','GovernmentController@editGovernment');
Route::post('/updateGovernment','GovernmentController@updateGovernment');
Route::get('/deleteGovernment/{id?}','GovernmentController@destroy');

//category
Route::get('/categories','CategoryController@index');
Route::post('/addCategory','CategoryController@addCategory');
Route::get('/editCategory/{id?}','CategoryController@editCategory');
Route::post('/updateCategory','CategoryController@updateCategory');
Route::get('/deleteCategory/{id?}','CategoryController@destroy');
Route::get('/countCategories','CategoryController@countCategories');

//subCategory
Route::get('/subCategory','SubCategoryController@index');
Route::post('/addSubCategory','SubCategoryController@addSubCategory');
Route::get('/editSubCategory/{id?}','SubCategoryController@editSubCategory');
Route::post('/updateSubCategory','SubCategoryController@updateSubCategory');
Route::get('/deleteSubCategory/{id?}','SubCategoryController@destroy');
Route::get('/countSubCategories','SubCategoryController@countSubCategories');


//single
Route::get('/allSingles','SingleController@index');
Route::post('/addSingle','SingleController@addSingle');
Route::get('/editSingle/{id?}','SingleController@editSingle');
Route::post('/updateSingle','SingleController@updateSingle');
Route::get('/deleteSingle/{id?}','SingleController@destroy');
Route::get('/countSingles','SingleController@countSingles');

//slider
Route::get('/allSliders','SliderController@index');
Route::post('/addSlider','SliderController@addSlider');
Route::get('/editSlider/{id?}','SliderController@editSlider');
Route::post('/updateSlider','SliderController@updateSlider');
Route::get('/deleteSlider/{id?}','SliderController@destroy');

//branch
Route::get('/allBranches','BranchController@index');
Route::post('/addBranch','BranchController@addBranch');
Route::get('/editBranch/{id?}','BranchController@editBranch');
Route::post('/updateBranch','BranchController@updateBranch');
Route::get('/deleteBranch/{id?}','BranchController@destroy');

//Advertise
Route::get('/allAdvertises','AdvertiseController@index');
Route::get('/editAdvertise/{id?}','AdvertiseController@editAdvertise');
Route::post('/updateAdvertise','AdvertiseController@updateAdvertise');
Route::get('/deleteAdvertise/{id?}','AdvertiseController@destroy');
Route::get('/countAdvertise','AdvertiseController@countAdvertise');

//Incorrect data
Route::get('/allErrorData','IncorrectdataController@index');
Route::get('/editErrorData/{id?}','IncorrectdataController@editIncorrectData');

//settings
Route::get('/setting','SettingController@index');
Route::post('/updateSettings','SettingController@updateSettings');



/**/



/*jwt auth*/
Route::post('auth/login','Api\AuthController@login');
Route::post('auth/refresh','Api\AuthController@refresh');
Route::get('auth/logout','Api\AuthController@logout');

Route::group(['middleware'=>'jwt.auth', 'namespace'=>'Api\\'], function (){
    Route::get('auth/me','AuthController@me');
    Route::post('auth/update','AuthController@updateUser');
});

/**/


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});getSliders

/*public website root*/
Route::get('settings','HomeController@getSiteSettings');

Route::get('governments','HomeController@getAllGovernments');

Route::get('slidersSubCat','HomeController@getSlidersSubCat');


Route::get('allCategories','HomeController@getAllCategories');

Route::get('subCategory/{id}','HomeController@getSubCategory');

Route::get('contact/{id}','HomeController@getContact');

Route::post('addContact','HomeController@addContact');

Route::get('search/{name}','HomeController@search');

Route::get('search/{name}','HomeController@search');

Route::get('contactTerm','HomeController@contactTerm');

/***/