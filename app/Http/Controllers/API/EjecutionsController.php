<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ejecution;

class EjecutionsController extends Controller
{
    public function ejecutions_by_client_id(Request $request)
    {
        return Ejecution::where('estado','ACTIVO')->where('client_id',$request->client_id)->with('client','plan')->get();
    }  
    public function list()
    {
        return Ejecution::where('estado','ACTIVO')->with('client','plan')->get(); 
    } 
    public function ejecution_check(Request $request)
    {
        $Ejecution = Ejecution::find($request->id);
        $Ejecution->verificado = "REALIZADO";
        $Ejecution->update();

        $Ejecutions = Ejecution::All()->where('client_id',$Ejecution->client_id)
        ->where('plan_id',$Ejecution->plan_id)
        ->where('verificado','!=','REALIZADO');

        foreach ($Ejecutions as $key => $value) {
            if ($value->id<$Ejecution->id) {
                $value->verificado = "VENCIDO";
                $value->update();
            }
        }


        return response()->json(['success'=>true,'msg'=>'Registro actualizado.']);
    } 

}
