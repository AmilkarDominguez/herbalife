<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Type;

class API_TiposController extends Controller
{
    public function list()
    {
        return Type::where('estado','ACTIVO')->with('user')->get();
    }  
}
