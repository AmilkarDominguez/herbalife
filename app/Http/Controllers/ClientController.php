<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ClientRequest;
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
            $pass = $request->password;
            $Client=User::create([
                'email_verified_at' => now(),
                'password' => Hash::make($pass),
                'remember_token' => str_random(10),
                'name' => $request->name,
                'email' => $request->email,
                'state' => $request->state,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'peso' => $request->peso,
                'estatura' => $request->estatura,
                'sexo' => $request->sexo,
                'direccion' => $request->direccion
            ]);

            // $Client=User::create($request->all());
            $Client->codigo= str_random(4).$Client->id;
            // $Client->password = Hash::make($request->password);
            $Client->update($request->all());

            $Client->roles()->attach(Role::where('name', 'CLIENTE')->first());


             //IMAGE 
             if($request->image&&$request->extension_image){
                $image = $request->image;
                $this->SaveFile($Client,$request->image, $request->extension_image, '/images/Clientes/');
            }
            return response()->json(['success' => true, 'msg' => 'Registro existoso.']);
        }
    }
    public function edit(Request $request)
    {
        $Client = User::find($request->id);
        return $Client->toJson();
    }
    public function update(Request $request)
    {
        $rule = new ClientRequest();
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors()->all()]);
        } else {
            $Client = User::find($request->id);
            $Client->update($request->all());

            if($request->image&&$request->extension_image){
                //Delete File
                Storage::disk('public')->delete($Client->foto);
                $this->SaveFile($Client,$request->image, $request->extension_image, '/images/Clientes/');
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
        $Client->estado = "ELIMINADO";
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
            $item->v=$visibility;
        return '<img src="'.$item->foto.'" alt="logo" width="125px" onclick="window.open(\''.$item->foto.'\');"></img>';
        })    
        ->addColumn('Editar', function ($item) use ($visibility) {
                $item->v = $visibility;
                return '<a class="btn btn-xs btn-primary text-white ' . $item->v . '" onclick="Edit(' . $item->id . ')" ><i class="icon-pencil"></i></a>';
            })
            ->addColumn('Eliminar', function ($item) use ($visibility) {
                $item->v = $visibility;
                return '<a class="btn btn-xs btn-danger text-white ' . $item->v . '" onclick="Delete(' . $item->id . ')" ><i class="icon-trash"></i></a>';
            })
            ->rawColumns(['Editar', 'Eliminar','Imagen'])
            ->toJson();
    }
}
