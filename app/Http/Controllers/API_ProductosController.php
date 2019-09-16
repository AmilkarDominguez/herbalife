<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;

class API_ProductosController extends Controller
{
    public function list()
    {
        return Product::where('estado','ACTIVO')->with('user','type')->get();
    }  
    public function list_JSON()
    {
        return Product::where('estado','ACTIVO')->with('user','type')->get()->toJson(); 
    }
}
