<?php

namespace App\Http\Controllers;

use App\Auspice;
use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\DataTables;
use App\Http\Requests\AuspiceRequest;
use Validator;

class AuspiceController extends Controller
{
    public function data_table()
    {
        //$isUser = auth()->user()->can(['provider.edit', 'provider.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        //if (!$isUser) {$visibility="disabled";}
            return datatables()->of(Auspice::all()->where('estado','!=','ELIMINADO'))
            ->addColumn('usuario', function ($item) {
                $user = User::find($item->user_id);
                return  $user->name;
            })
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
    public function index()
    {
        return view('content.auspices');
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $rule = new AuspiceRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            Auspice::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function update(Request $request)
    {
        $rule = new AuspiceRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Auspice = Auspice::find($request->id);
            $Auspice->update($request->all());
            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $Auspice = Auspice::find($request->id);
        $Auspice->estado = "ELIMINADO";
        $Auspice->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
    public function show($id)
    {
        $Auspice = Auspice::find($id);
        return $Auspice->toJson();
    }
    public function edit(Request $request)
    {
        $Auspice = Auspice::find($request->id);
        return $Auspice->toJson();
    }  
}
