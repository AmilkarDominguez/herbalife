<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Role;
use App\Diet;
use App\ClientDiet;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientUpdateRequest;

use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function index()
    {
        return view('content.clients');
    }
    public function store(Request $request)
    {
        $rule = new ClientRequest();
        $validator = Validator::make($request->all(), $rule->rules());

        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors()->all()]);
        } else {
            //return response()->json(['success' => false, 'msg' => 'llegando!!']);
            $Client = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'state' => $request->state,
                'state_rol' => 'CLIENTE',
                'email_verified_at' => now(),
                'password' => bcrypt($request->password),
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'sexo' => $request->sexo,
                'estatura' => $request->estatura,
                'peso' => $request->peso,
                'direccion' => $request->direccion,
                'remember_token' => str_random(10)
            ]);

            $Client->codigo = str_random(4) . $Client->id;
            $Client->save();
            $Client->roles()->attach(Role::where('name', 'CLIENTE')->first());

            $tokenResult = $Client->createToken('Token de acceso personal');
            $token = $tokenResult->token;
            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
            //return response()->json(['success' => true, 'msg' => $token]);

            //IMAGE 
            if ($request->image && $request->extension_image) {
                $image = $request->image;
                $this->SaveFile($Client, $request->image, $request->extension_image, '/images/Clientes/');
            }
            $this->AssignedDiet($Client);
            return response()->json(['success' => true, 'msg' => 'Registro existoso.']);
        }
    }
    //Asignando dieta
    public function AssignedDiet(User $c_)
    {
        if ($c_->sexo == 'HOMBRE') {
            if ($c_->peso >= 0  && $c_->peso <= 65) {

                if ($c_->estatura > 0 && $c_->estatura <= 160) {
                    //1v
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 1,
                    ]);
                    return;
                }
                if ($c_->estatura >= 161 && $c_->estatura <= 170) {
                    //2v
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 2,
                    ]);
                    return;
                }
                if ($c_->estatura >= 171) {
                    //3v
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 3,
                    ]);
                    return;
                }
            }

            if ($c_->peso >= 66  && $c_->peso <= 75) {

                if ($c_->estatura > 0 && $c_->estatura <= 160) {
                    //2v
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 2,
                    ]);
                    return;
                }
                if ($c_->estatura >= 161 && $c_->estatura <= 170) {
                    //3v
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 3,
                    ]);
                    return;
                }
                if ($c_->estatura >= 171) {
                    //4v
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 4,
                    ]);
                    return;
                }
            }

            if ($c_->peso >= 76) {

                if ($c_->estatura > 0 && $c_->estatura <= 160) {
                    //3v
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 3,
                    ]);
                    return;
                }
                if ($c_->estatura >= 161 && $c_->estatura <= 170) {
                    //4v
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 4,
                    ]);
                    return;
                }
                if ($c_->estatura >= 171) {
                    //5v
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 5,
                    ]);
                    return;
                }
            }
        }
        if ($c_->sexo == 'MUJER') {
            if ($c_->peso >= 0  && $c_->peso <= 50) {

                if ($c_->estatura > 0 && $c_->estatura <= 160) {
                    //1m
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 6,
                    ]);
                    return;
                }
                if ($c_->estatura >= 161 && $c_->estatura <= 170) {
                    //2m
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 7,
                    ]);
                    return;
                }
                if ($c_->estatura >= 171) {
                    //3m
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 8,
                    ]);
                    return;
                }
            }

            if ($c_->peso >= 51  && $c_->peso <= 60) {

                if ($c_->estatura > 0 && $c_->estatura <= 160) {
                    //2m
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 7,
                    ]);
                    return;
                }
                if ($c_->estatura >= 161 && $c_->estatura <= 170) {
                    //3m
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 8,
                    ]);
                    return;
                }
                if ($c_->estatura >= 171) {
                    //4m
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 9,
                    ]);
                    return;
                }
            }

            if ($c_->peso >= 61) {

                if ($c_->estatura > 0 && $c_->estatura <= 160) {
                    //3m
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 8,
                    ]);
                    return;
                }
                if ($c_->estatura >= 161 && $c_->estatura <= 170) {
                    //4m
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 9,
                    ]);
                    return;
                }
                if ($c_->estatura >= 171) {
                    //5m
                    ClientDiet::create([
                        'client_id' => $c_->id,
                        'diet_id' => 10,
                    ]);
                    return;
                }
            }
        }
    }
    public function show($id)
    {
        $Client = User::find($id);
        return $Client->toJson();
    }
    public function edit(Request $request)
    {
        $Client = User::find($request->id);
        return $Client->toJson();
    }
    public function update(Request $request)
    {
        $rule = new ClientUpdateRequest();
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors()->all()]);
        } else {

            $Client = User::find($request->id);
            // $request->password= bcrypt($request->password);
            // $Client->update($request->all());

            //Borrando registro dieta
            if (ClientDiet::where('client_id', $request->id)->exists()) {
                $cd = ClientDiet::where('client_id', $request->id);
                $cd->delete();
            }

            $Client->update([
                'name' => $request->name,
                'email' => $request->email,
                'state' => $request->state,
                'state_rol' => 'CLIENTE',
                'password' => bcrypt($request->password),
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'sexo' => $request->sexo,
                'estatura' => $request->estatura,
                'peso' => $request->peso,
                'direccion' => $request->direccion
            ]);


            $this->AssignedDiet($Client);

            if ($request->image && $request->extension_image) {
                //Delete File
                Storage::disk('public')->delete($Client->foto);
                $this->SaveFile($Client, $request->image, $request->extension_image, '/images/Clientes/');
            }

            return response()->json(['success' => true, 'msg' => 'Se actualizo existosamente.']);
        }
    }
    public function SaveFile($obj, $code, $extension_file, $path)
    {
        $image = $code;
        switch ($extension_file) {
            case 'jpg':
                $image = str_replace('data:image/jpeg;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageURL = $path . str_random(10) . $obj->id . '.jpg';
                Storage::disk('public')->put($imageURL,  base64_decode($image));
                $obj->foto = $imageURL;
                $obj->save();
                return response()->json(['success' => true, 'msg' => 'Registro existoso']);
                break;
            case 'png':
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageURL = $path . str_random(10) . $obj->id . '.png';
                Storage::disk('public')->put($imageURL,  base64_decode($image));
                $obj->foto = $imageURL;
                $obj->save();
                return response()->json(['success' => true, 'msg' => 'Registro existoso']);
                break;
            case 'gif':
                $image = str_replace('data:image/gif;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageURL = $path . str_random(10) . $obj->id . '.gif';
                Storage::disk('public')->put($imageURL,  base64_decode($image));
                $obj->foto = $imageURL;
                $obj->save();
                return response()->json(['success' => true, 'msg' => 'Registro existoso asdasd']);
                break;
            default:
                return response()->json(['success' => false, 'msg' => 'Registro existoso, imágen no aceptada solo esta permitido imágenes JPG, GIF ó PNG.']);
                break;
        }
    }
    public function destroy(Request $request)
    {
        $Client = User::find($request->id);
        $Client->state = "ELIMINADO";
        $Client->update();
        return response()->json(['success' => true, 'msg' => 'Registro borrado.']);
    }
    public function data_table()
    {
        //$isUser = auth()->user()->can(['provider.edit', 'provider.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        //if (!$isUser) {$visibility="disabled";}
        // return datatables()->of(Transport::where('state','!=','ELIMINADO')->with('transport_type','language')->get())
        return datatables()->of(User::where('state', '!=', 'ELIMINADO')->where('state_rol', 'CLIENTE'))
            ->addColumn('Imagen', function ($item) use ($visibility) {
                $item->v = $visibility;
                return '<img src="' . $item->foto . '" alt="logo" width="125px" onclick="window.open(\'' . $item->foto . '\');"></img>';
            })
            ->addColumn('Editar', function ($item) use ($visibility) {
                $item->v = $visibility;
                return '<a class="btn btn-xs btn-primary text-white ' . $item->v . '" onclick="Edit(' . $item->id . ')" ><i class="icon-pencil"></i></a>';
            })
            ->addColumn('Eliminar', function ($item) use ($visibility) {
                $item->v = $visibility;
                return '<a class="btn btn-xs btn-danger text-white ' . $item->v . '" onclick="Delete(' . $item->id . ')" ><i class="icon-trash"></i></a>';
            })
            ->rawColumns(['Editar', 'Eliminar', 'Imagen'])
            ->toJson();
    }
}
