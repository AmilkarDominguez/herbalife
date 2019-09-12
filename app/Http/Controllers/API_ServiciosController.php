<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Service;

class API_ServiciosController extends Controller
{
    public function list()
    {
        return Service::where('estado','ACTIVO')->with('user')->get();
    }  
    public function list_JSON()
    {
        return Service::where('estado','ACTIVO')->with('user')->get()->toJson(); 
    }
}
