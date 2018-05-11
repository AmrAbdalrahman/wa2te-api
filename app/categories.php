<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $table = "categories";

    protected $fillable =['name_en','name_ar','img'];

    public function contacts()
    {
        return $this->belongsToMany('App\contacts', 'contact_category', 'cat_id', 'contact_id');
    }

    public function subCategories()
    {
        return $this->hasMany('App\sub_categories', 'cat_id');


    }

}
