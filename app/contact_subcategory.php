<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact_subcategory extends Model
{
    protected $table = "contact_subcategory";

    protected $fillable =['id','subcat_id','contact_id','created_at','updated_at'];

    public $timestamps = true;

    public function sub_categories()
    {
        return $this->belongsTo('\App\sub_categories', 'subcat_id');

    }

    public function contact()
    {
        return $this->belongsTo('\App\contacts', 'contact_id');

    }

}
