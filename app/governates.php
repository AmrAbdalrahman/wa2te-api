<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class governates extends Model
{
    protected $table = "governates";
    protected $fillable =['name_en','name_ar','img'];

    public function contacts()
    {
        return $this->belongsToMany('App\contacts', 'contact_governate', 'governate_id', 'contact_id');
    }



    }
