<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    protected $table = "advertise";
    protected $fillable =['name','view' ,'email', 'phone', 'desc', 'type', 'updated_at', 'created_at'];

}
