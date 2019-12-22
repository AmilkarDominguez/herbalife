<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EjecutionsController extends Controller
{
    public function list(Request $request)
    {
        return Institutional::where('estado','ACTIVO')->get();
    }  
}
