<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Illuminate\Http\Request;
use App\User;
use App\Auspice;


class API_AdvertisementController extends Controller
{
    public function list()
    {
        return Advertisement::where('estado','ACTIVO')->with('user','auspice')->get();
    }  
    public function list_JSON()
    {
        return Advertisement::where('estado','ACTIVO')->with('user','auspice')->get()->toJson(); 
    }
}
