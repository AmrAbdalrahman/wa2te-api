<?php

namespace App\Http\Controllers;

use App\incorrectdata;
use Illuminate\Http\Request;

class IncorrectdataController extends Controller
{
    public function index()
    {
        $incorrectdata = incorrectdata::orderBy('id', 'desc')->get();
        return response()->json($incorrectdata);
    }

    public function editIncorrectData($id)
    {
        $incorrectdata = incorrectdata::find($id);
        $incorrectdata->fill(['view' => 1])->save();
        //return response()->json(array($incorrectdata));
    }
}
