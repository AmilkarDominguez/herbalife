<?php

namespace App\Http\Controllers;

use App\Institutional;
use Illuminate\Http\Request;
use App\User;


class API_InstitutionalController extends Controller
{
    public function list()
    {
        return Institutional::where('estado','ACTIVO')->with('user')->get();
    }
    public function list_JSON()
    {
        return Institutional::where('estado','ACTIVO')->with('user')->get()->toJson(); 
    }
}
