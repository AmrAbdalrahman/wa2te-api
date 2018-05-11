<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    //
    protected $table = "settings";
    protected $fillable =['name', 'address', 'phone', 'lat', 'lng', 'email', 'fb', 'twitter', 'instgram', 'linkedin', 'keywords', 'vision_en', 'mission_en', 'vision_ar', 'mission_ar','created_at', 'updated_at'];

}
