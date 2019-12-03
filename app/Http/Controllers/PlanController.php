<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Routine;
use App\Plan;
use Yajra\DataTables\DataTables;
use App\Http\Requests\PlanRequest;
use Validator;

class PlanController extends Controller
{

    public function index()
    {
        return view('content.plan');
    }

    public function store(Request $request)
    {
        $rule = new PlanRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            Plan::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function edit(Request $request)
    {
        $Plan = Plan::find($request->id);
        return $Plan->toJson();
    }

    public function update(Request $request)
    {
        $rule = new PlanRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Plan = Plan::find($request->id);
            $Plan->update($request->all());
            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }

    public function destroy(Request $request)
    {
        $Plan = Plan::find($request->id);
        $Plan->estado = "ELIMINADO";
        $Plan->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
     public function data_table()
     {
             return datatables()->of(Plan::where('estado','!=','ELIMINADO')->with('user','client')->get())
            //  ->addColumn('Editar', function ($item) {
            //  return '<a class="btn btn-xs btn-primary text-white onclick="Edit('.$item->id.')" ><i class="icon-pencil"></i></a>';
            //  })
            //  ->addColumn('Eliminar', function ($item) {
            //      return '<a class="btn btn-xs btn-danger text-white onclick="Delete(\''.$item->id.'\')"><i class="icon-trash"></i></a>';
            //      })
            //  ->rawColumns(['Editar','Eliminar'])    
             ->toJson();   
     }
     public function list_clients()
     {
         return User::where('state','ACTIVO')->where('state_rol', 'CLIENTE')->get();
     }  
     public function list_routines()
     {
         return Routine::where('estado','ACTIVO')->with('user')->get();
     }
}
