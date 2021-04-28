<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;

class UserAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRol(['ADMINISTRADOR']);

        return view('configuration.user');
    }

    public function store(Request $request)
    {
        $rule = new UserRequest();
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors()->all()]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'state' => $request->state,
                'state_rol' => 'ADMINISTRADOR',
                'email_verified_at' => now(),
                'password' => bcrypt($request->password),
                'remember_token' => str_random(10)

            ]);

            $user
                ->roles()
                ->attach(Role::where('name', 'ADMINISTRADOR')->first());


            return response()->json(['success' => true, 'msg' => 'Registro existoso.']);
        }
    }
    public function edit(Request $request)
    {
        $User = User::find($request->id);
        return $User->toJson();
    }
    public function update(Request $request)
    {
        //return response()->json(['success' => false, 'msg' => $request->rol]);
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'  => 'string|email|max:255',
            'email' => ['required', Rule::unique('users')->ignore($request->id),],
            'state'    => 'required|string',
            'password' => 'nullable|string|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors()->all()]);
        } else {
            $User = User::find($request->id);

            if ($request->password) {

                $User->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'state' => $request->state,
                    //'state_rol' => $request->rol,
                    //'state_rol' => 'ASESOR',
                    'password' => bcrypt($request->password),


                ]);
                $User->state_rol = $request->rol;
                $User->update();
                //$rol = Role::find($request->rol);

                //$User->roles()->attach($rol);
            } else {
                $User->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'state' => $request->state,
                    //'state_rol' => $request->rol,
                    //'state_rol' => 'ASESOR'
                ]);
                $User->state_rol = $request->rol;
                $User->update();
                //return response()->json(['success' => false, 'msg' => $User]);
                //$rol = Role::find($request->rol);

                //$User->roles()->attach($rol);
            }


            return response()->json(['success' => true, 'msg' => 'Se actualizo existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $User = User::find($request->id);
        $User->state = "ELIMINADO";
        $User->update();
        return response()->json(['success' => true, 'msg' => 'Registro borrado.']);
    }
    public function data_table()
    {

        if (Auth::user()->hasRole('ADMINISTRADOR')) {
            //return datatables()->of(User::all()->where('state', '!=', 'ELIMINADO')->where('state_rol', 'ADMINISTRADOR'))
            return datatables()->of(User::all()->where('state', '!=', 'ELIMINADO'))
                //use para usar varible externa
                ->addColumn('Editar', function ($item) {
                    return '<a class="btn btn-xs btn-primary text-white " onclick="Edit(' . $item->id . ')" ><i class="icon-pencil"></i></a>';
                })
                ->addColumn('Eliminar', function ($item) {
                    return '<a class="btn btn-xs btn-danger text-white " onclick="Delete(\'' . $item->id . '\')"><i class="icon-trash"></i></a>';
                })
                ->rawColumns(['Editar', 'Eliminar'])
                ->toJson();
        } else {

            return null;
        }
    }
}
