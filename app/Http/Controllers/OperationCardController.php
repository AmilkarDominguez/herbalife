<?php

namespace App\Http\Controllers;

use App\Operation_card;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\OperationCardRequest;
use Validator;

class OperationCardController extends Controller
{

    public function index()
    {
        return view('content.operation_card');
    }
    public function store(Request $request)
    {
        $rule = new OperationCardRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            Operation_card::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function show($id)
    {
        //
    }
    public function edit(Request $request)
    {
        $Operation_card = Operation_card::find($request->id);
        return $Operation_card->toJson();
    }
    public function update(Request $request)
    {
        $rule = new OperationCardRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Operation_card = Operation_card::find($request->id);
            $Operation_card->update($request->all());
            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $Operation_card = Operation_card::find($request->id);
        $Operation_card->estado = "ELIMINADO";
        $Operation_card->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
    //FUNCTIONS
    public function data_table()
    {
        //$isUser = auth()->user()->can(['provider.edit', 'provider.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        //if (!$isUser) {$visibility="disabled";}
            return datatables()->of(Operation_card::where('estado','!=','ELIMINADO')->with('user')->get())
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
