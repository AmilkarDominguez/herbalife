<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Plan;

class PlansController extends Controller
{
    public function plans_by_client_id(Request $request)
    {
        return Plan::where('estado','ACTIVO')->where('client_id',$request->client_id)->get();
    }  
    public function list()
    {
        return Plan::where('estado','ACTIVO')->with('client','routine')->get(); 
    }
    public function first_plans_by_client_id(Request $request)
    {
        // return Plan::where('estado','ACTIVO')->where('client_id',$request->client_id)->first();
        return Plan::where('estado','ACTIVO')->where('client_id',$request->client_id)->orderByRaw('id DESC')->first();
    }   
}
