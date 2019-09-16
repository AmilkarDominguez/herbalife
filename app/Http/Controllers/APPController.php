<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class APPController extends Controller
{
    public function institucional()
    {
        return view('app_.institucional');
    }  
    public function productos()
    {
        return view('app_.productos');
    }  
}
