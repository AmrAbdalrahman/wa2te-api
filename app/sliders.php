<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sliders extends Model
{
    //
    protected $table = "sliders";
    protected $fillable =['contact_id', 'subcat_id', 'slider_type','end_date', 'img', 'title_en', 'desc_en', 'title_ar', 'desc_ar', 'created_at', 'updated_at'];

    public function subCategory()
    {
        return $this->belongsTo('App\sub_categories', 'subcat_id');
    }

    public function contact()
    {
        return $this->belongsTo('App\contacts', 'contact_id');
    }
}
