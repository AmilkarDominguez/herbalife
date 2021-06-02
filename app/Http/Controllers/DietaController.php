<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Diet;
use Yajra\DataTables\DataTables;
use App\Http\Requests\DietRequest;
use Validator;

class DietaController extends Controller
{

    public function index()
    {
        return view('content.dieta');
    }

    public function store(Request $request)
    {
        $rule = new DietRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            Diet::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function edit(Request $request)
    {
        $type = Diet::find($request->id);
        return $type->toJson();
    }

    public function update(Request $request)
    {
        $rule = new DietRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Diet = Diet::find($request->id);
            $Diet->update($request->all());
            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }

    public function destroy(Request $request)
    {
        $Diet = Diet::find($request->id);
        $Diet->estado = "ELIMINADO";
        $Diet->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
     //FUNCTIONS
     public function data_table()
     {
         //$isUser = auth()->user()->can(['provider.edit', 'provider.destroy']);
         //Variable para la visiblidad
         $visibility = "";
         //if (!$isUser) {$visibility="disabled";}
             return datatables()->of(Diet::where('estado','!=','ELIMINADO')->get())
             ->addColumn('Editar', function ($item) {
             return '<a class="btn btn-xs btn-primary text-white" onclick="Edit('.$item->id.')" ><i class="icon-pencil"></i></a>';
             })
             ->addColumn('Eliminar', function ($item) {
                 return '<a class="btn btn-xs btn-danger text-white" onclick="Delete(\''.$item->id.'\')"><i class="icon-trash"></i></a>';
                 })
             ->rawColumns(['Editar','Eliminar'])    
             ->toJson();   
     }
}
