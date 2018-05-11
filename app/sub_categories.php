<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class sub_categories extends Model
{
    protected $table="sub_categories";
    protected $fillable =['cat_id','name_en','name_ar','img'];

    public function category()
    {
        return $this->belongsTo('App\categories', 'cat_id');
    }

//    public function contacts()
//    {
//        return $this->belongsToMany('App\contacts','contact_subcategory','subcat_id','contact_id')->withTimestamps();
//    }
    public function sliders()
    {
        $currentDate = Carbon::now();
        return $this->hasMany('App\sliders','subcat_id')->where('end_date','>=',$currentDate);

    }
    public function contacts()
    {
        return $this->hasMany('App\contacts','subcat_id');

    }

}
