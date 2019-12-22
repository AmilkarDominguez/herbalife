<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Institutional;

class InstitutionalController extends Controller
{
    public function list()
    {
        return Institutional::where('estado','ACTIVO')->get();
    }  
    public function list_JSON()
    {
        return Institutional::where('estado','ACTIVO')->get()->toJson(); 
    }
}
