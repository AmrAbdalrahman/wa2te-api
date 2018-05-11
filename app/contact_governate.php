<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact_governate extends Model
{
    protected $table = "contact_governate";

    protected $fillable =['id','governate_id','contact_id','created_at','updated_at'];

    public $timestamps = true;

    public function governates()
    {
        return $this->belongsTo('\App\governates', 'governate_id');

    }

    public function contact()
    {
        return $this->belongsTo('\App\contacts', 'contact_id');

    }

}
