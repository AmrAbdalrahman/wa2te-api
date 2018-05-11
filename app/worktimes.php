<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class worktimes extends Model
{
    protected $table = "work_times";

    public function category()
    {
        return $this->belongsTo('App\contacts', 'contact_id');
    }


}
