<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Bus;
use App\User;
use Yajra\DataTables\DataTables;
use App\Http\Requests\BusRequest;

class BusController extends Controller
{
    public function index()
    {
        return view('content.bus');
    }
    public function store(Request $request)
    {
        $rule = new BusRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            Bus::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function edit(Request $request)
    {
        $Bus = Bus::find($request->id);
        return $Bus->toJson();
    }
    public function update(Request $request)
    {
        $rule = new BusRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Bus = Bus::find($request->id);
            $Bus->update($request->all());
            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $Bus = Bus::find($request->id);
        $Bus->estado = "ELIMINADO";
        $Bus->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
    public function data_table()
    {
        //$isUser = auth()->user()->can(['provider.edit', 'provider.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        //if (!$isUser) {$visibility="disabled";}
            return datatables()->of(Bus::where('estado','!=','ELIMINADO')->with('user','operation')->get())
            ->addColumn('Editar', function ($item) use ($visibility) {
                $item->v=$visibility;
            return '<a class="btn btn-xs btn-primary text-white '.$item->v.'" onclick="Edit('.$item->id.')" ><i class="icon-pencil"></i></a>';
            })
            ->addColumn('Eliminar', function ($item) use ($visibility) {
                $item->v=$visibility;
            return '<a class="btn btn-xs btn-danger text-white '.$item->v.'" onclick="Delete('.$item->id.')" ><i class="icon-trash"></i></a>';
            })
            ->rawColumns(['Editar','Eliminar']) 
            ->toJson();   
    }
}
