<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class contacts extends Model
{
    protected $table = "contacts";

    protected $fillable =['title_en', 'title_ar', 'desc_en', 'desc_ar', 'address_en', 'address_ar', 'phone', 'website', 'fb', 'twitter', 'instgram', 'linkedin', 'square_img', 'rect_img', 'gif_img', 'keywords', 'created_at', 'updated_at', 'lat', 'lon'];
    public function subCategories()
    {
        return $this->belongsToMany('App\sub_categories','contact_subcategory','contact_id','subcat_id');

    }

    /*public function subCategory()
    {
        return $this->belongsTo('App\sub_categories','subcat_id');
    }*/

//    public function governates()
//    {
//        return $this->belongsToMany('App\governates','contact_governate','contact_id','governate_id');
//
//    }

    public function branches(){
        return $this->hasMany('App\branches', 'contact_id');
    }

    public function workTimes(){
        return $this->hasMany('App\worktimes', 'contact_id');

    }

    public function sliders()
    {
        $currentDate = Carbon::now();
        return $this->hasMany('App\sliders','contact_id')->where('end_date','>=',$currentDate);
    }

    /*public function governments()
    {
        return $this->belongsToMany('App\governates', 'contact_governate', 'contact_id','governate_id');
    }*/

    public function categories(){
        return $this->belongsToMany('App\categories', 'contact_category', 'contact_id','cat_id');
    }

    public function governements()
    {
        return $this->belongsToMany('App\governates', 'contact_governate', 'contact_id', 'governate_id');
    }

    public function governementSearch($id)
    {
        return $this->belongsToMany('App\governates', 'contact_governate', 'contact_id', 'governate_id')->where('contact_governate.governate_id','=',$id)->first();
    }

    }
