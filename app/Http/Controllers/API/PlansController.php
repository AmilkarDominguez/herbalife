<?php

namespace App\Http\Controllers\API;

use App\Ejecution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Plan;

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
                $porcentaje =   ($metas_realizado * $aux)/100;
            }
            $plan->porcentaje = round($porcentaje, 2);
        }

        return  $plan;
    }
}
