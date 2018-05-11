<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class branches extends Model
{
    protected $table = "branches";

    protected $fillable =['governate_id', 'contact_id','title_ar', 'title_en', 'desc_ar', 'desc_en', 'img', 'address', 'phone', 'lat', 'lng', 'created_at', 'updated_at'];

    public function contact()
    {
        return $this->belongsTo('App\contacts', 'contact_id');
    }


}
