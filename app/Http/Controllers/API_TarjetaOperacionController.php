<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Operation_card;

class API_TarjetaOperacionController extends Controller
{
    public function list()
    {
        return Operation_card::where('estado','ACTIVO')->with('user')->get();
    }  
}
