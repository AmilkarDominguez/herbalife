<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Routine;
use App\Ejecution;
use Yajra\DataTables\DataTables;
use Validator;

class EjecutionController extends Controller
{

    public function index()
    {
        return view('content.ejecution');
    }

     public function data_table(Request $request)
     {
             return datatables()->of(Ejecution::where('estado','!=','ELIMINADO')->where('client_id',$request->client_id)->with('client','plan')->get())
             ->toJson();   
     }
}
