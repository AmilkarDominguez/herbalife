<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Place;
use Yajra\DataTables\DataTables;
use App\Http\Requests\PlaceRequest;
use Validator;

class ZonaController extends Controller
{
    public function index()
    {
        return view('configuration.zona');
    }
    public function store(Request $request)
    {
        $rule = new PlaceRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            Place::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function edit(Request $request)
    {
        $zona = Place::find($request->id);
        return $zona->toJson();
    }
    public function update(Request $request)
    {
        $rule = new PlaceRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Place = Place::find($request->id);
            $Place->update($request->all());
            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $Place = Place::find($request->id);
        $Place->estado = "ELIMINADO";
        $Place->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
     //FUNCTIONS
    public function data_table()
    {
        //$isUser = auth()->user()->can(['provider.edit', 'provider.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        //if (!$isUser) {$visibility="disabled";}
            return datatables()->of(Place::where('estado','!=','ELIMINADO')->with('user')->get())
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
