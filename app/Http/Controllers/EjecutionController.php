<?php

namespace App\Http\Controllers;





use Illuminate\Http\Request;
use Validator;
use App\Ejecution;
use App\User;
use App\Role;
use App\Diet;
use App\ClientDiet;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientUpdateRequest;

class EjecutionController extends Controller
{

    public function index()
    {
        return view('content.ejecution');
    }

    public function data_table(Request $request)
    {
        return datatables()->of(Ejecution::where('estado', '!=', 'ELIMINADO')->where('client_id', $request->client_id)->with('client', 'plan')->get())
            ->toJson();
    }
    public function data_table_clients()
    {
        return datatables()->of(User::where('state', '!=', 'ELIMINADO')->where('state_rol', 'CLIENTE'))
            ->addColumn('Seleccionar', function ($item) {
                return '<a class="btn btn-xs btn-success text-white " onclick="ListDatatable(' . $item->id . ')" ><i class="icon-check"></i></a>';
            })
            ->rawColumns(['Seleccionar'])
            ->toJson();
    }
}
