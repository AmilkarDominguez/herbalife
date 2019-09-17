<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Routine;

class API_RutinaController extends Controller
{
    public function list()
    {
        return Routine::where('estado','ACTIVO')->with('user')->get();
    } 
}
