<?php

namespace App\Http\Controllers;

use App\Institutional;
use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\DataTables;
use App\Http\Requests\InstitutionalRequest;
use Validator;

class InstitutionalController extends Controller
{

    public function index()
    {
        return view('configuration.institutional');
    }
    public function store(Request $request)
    {
        $rule = new InstitutionalRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            Institutional::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function update(Request $request)
    {
        $rule = new InstitutionalRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Institutional = Institutional::find($request->id);
            $Institutional->update($request->all());
            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $Institutional = Institutional::find($request->id);
        $Institutional->estado = "ELIMINADO";
        $Institutional->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
    public function show($id)
    {
        $Institutional = Institutional::find($id);
        return $Institutional->toJson();
    }
    public function edit(Request $request)
    {
        $Institutional = Institutional::find($request->id);
        return $Institutional->toJson();
    }
    //FUNCTIONS
    public function data_table()
    {
        //$isUser = auth()->user()->can(['provider.edit', 'provider.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        //if (!$isUser) {$visibility="disabled";}
            return datatables()->of(Institutional::where('estado','!=','ELIMINADO')->with('user')->get())
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
