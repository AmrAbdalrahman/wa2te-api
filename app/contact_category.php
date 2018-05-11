<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact_category extends Model
{
    protected $table = "contact_category";

    protected $fillable =['id','cat_id','contact_id','created_at','updated_at'];

    public $timestamps = true;

    public function categories()
    {
        return $this->belongsTo('\App\categories', 'cat_id');

    }

    public function contact()
    {
        return $this->belongsTo('\App\contacts', 'contact_id');

    }

}
