<?php

namespace App\Http\Controllers\API;

use App\Ejecution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Plan;
use App\ClientDiet;
use App\Diet;
use App\Type;

class PlansController extends Controller
{
    public function plans_by_client_id(Request $request)
    {
        return Plan::where('estado', 'ACTIVO')->where('client_id', $request->client_id)->get();
    }
    public function list()
    {
        return Plan::where('estado', 'ACTIVO')->with('client', 'routine')->get();
    }
    public function first_plans_by_client_id(Request $request)
    {
        // return Plan::where('estado','ACTIVO')->where('client_id',$request->client_id)->first();

        $plan = Plan::where('estado', 'ACTIVO')->where('client_id', $request->client_id)->orderByRaw('id DESC')->first();
        if ($plan) {
            $metas_total = Ejecution::all()->where('estado', 'ACTIVO')->where('plan_id', $plan->id)->where('client_id', $request->client_id);
            $metas_total = count($metas_total);
            //$metas_realizado = Ejecution::where('estado','ACTIVO')->where('plan_id',$plan->id)->where('verificado','REALIZADO');
            $metas_realizado = Ejecution::all()->where('estado', 'ACTIVO')->where('plan_id', $plan->id)->where('client_id', $request->client_id)->where('verificado', 'REALIZADO');
            $metas_realizado = count($metas_realizado);
            $plan->metas_total = $metas_total;
            $plan->metas_realizado = $metas_realizado;

            if ($metas_total) {
                $aux = 100 / $metas_total;
                $porcentaje =   ($metas_realizado * $aux) / 100;
            }
            $plan->porcentaje = round($porcentaje, 2);
        }


        //Dieta
        $clientDiet = ClientDiet::where('client_id', $request->client_id)->first();

        //$clientDiet = ClientDiet::all();
        if ($clientDiet) {
            $diet_ = Diet::find($clientDiet->diet_id);
            $plan->diet = $diet_;
        }
        return  $plan;
    }
    public function diet_by_client_id(Request $request)
    {
        /*$clientDiet = ClientDiet::find(1);
        return $clientDiet->diet_id;*/



        //return $request;
        $clientDiet = ClientDiet::where('client_id', $request->client_id)->first();
        //return $clientDiet->diet_id;

        $Diet = Diet::find($clientDiet->diet_id);
        return $Diet;
    }
}
