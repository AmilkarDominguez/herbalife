<?php

namespace App\Http\Controllers;

use App\Auspice;
use Illuminate\Http\Request;
use App\User;


class API_AuspiceController extends Controller
{
    public function list()
    {
        return Auspice::where('estado','ACTIVO')->with('user')->get();
    }  
    public function list_JSON()
    {
        return Auspice::where('estado','ACTIVO')->with('user')->get()->toJson(); 
    }
}
