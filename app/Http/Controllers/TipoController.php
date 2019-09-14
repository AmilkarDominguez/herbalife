<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Type;
use Yajra\DataTables\DataTables;
use App\Http\Requests\TypeRequest;
use Validator;

class TipoController extends Controller
{

    public function index()
    {
        return view('configuration.tipo');
    }

    public function store(Request $request)
    {
        $rule = new TypeRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            Type::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function edit(Request $request)
    {
        $type = Type::find($request->id);
        return $type->toJson();
    }

    public function update(Request $request)
    {
        $rule = new TypeRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Type = Type::find($request->id);
            $Type->update($request->all());
            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }

    public function destroy(Request $request)
    {
        $Type = Type::find($request->id);
        $Type->estado = "ELIMINADO";
        $Type->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
     //FUNCTIONS
     public function data_table()
     {
         //$isUser = auth()->user()->can(['provider.edit', 'provider.destroy']);
         //Variable para la visiblidad
         $visibility = "";
         //if (!$isUser) {$visibility="disabled";}
             return datatables()->of(Type::where('estado','!=','ELIMINADO')->with('user')->get())
             ->addColumn('Editar', function ($item) use ($visibility) {
                 $item->v=$visibility;
             return '<a class="btn btn-xs btn-primary text-white '.$item->v.'" onclick="Edit('.$item->id.')" ><i class="icon-pencil"></i></a>';
             })
             ->addColumn('Eliminar', function ($item) {
                 return '<a class="btn btn-xs btn-danger text-white '.$item->v.'" onclick="Delete(\''.$item->id.'\')"><i class="icon-trash"></i></a>';
                 })
             ->rawColumns(['Editar','Eliminar'])    
             ->toJson();   
     }
}
