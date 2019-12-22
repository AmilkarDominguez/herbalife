<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Product;

class ProductsController extends Controller
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
