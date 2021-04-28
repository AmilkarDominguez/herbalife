<?php

namespace App\Http\Controllers\API;

use App\Detail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ejecution;
use App\Routine;

class EjecutionsController extends Controller
{
    public function ejecutions_by_client_id(Request $request)
    {
        $ejecutions = Ejecution::where('estado','ACTIVO')->where('client_id',$request->client_id)->with('plan')->get();
        /*$routine = Routine::where('estado','ACTIVO')->where('id',$ejecutions[0]->plan->routine_id)->firstOrFail();
        
        //$ejecutions->routine = $routine;

        $datails = Detail::where('estado','ACTIVO')->where('routine_id',$routine->id)->with('product')->get();

        $ejecutions->detalles = $datails;*/
        return $ejecutions;
    }  
    public function details_by_client_id(Request $request)
    {
        $ejecutions = Ejecution::where('estado','ACTIVO')->where('client_id',$request->client_id)->with('plan')->get();
        $routine = Routine::where('estado','ACTIVO')->where('id',$ejecutions[0]->plan->routine_id)->firstOrFail();
        
        //$ejecutions->routine = $routine;

        $datails = Detail::where('estado','ACTIVO')->where('routine_id',$routine->id)->with('product')->get();

        
        return $datails;
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
