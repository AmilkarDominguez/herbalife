<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Routine;
use App\Product;
use App\Detail;
use Yajra\DataTables\DataTables;
use App\Http\Requests\RoutineRequest;
use Illuminate\Support\Facades\Storage;

class RutinaController extends Controller
{

    public function index()
    {
        return view('content.routine');
    }
    public function create_routine()
    {
        return view('content.create_routine');
    }
    public function asignar_plan()
    {
        return view('content.asignar_plan');
    }
    
    public function store(Request $request)
    {
        $rule = new RoutineRequest();
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors()->all()]);
        } else {
            $Routine = Routine::create($request->all());
            return response()->json(['success' => true, 'msg' => 'Registro existoso.', 'routine_id' => $Routine->id]);
        }
    }
    public function save_detail(Request $request)
    {
        $Detail = Detail::create($request->all());
        return response()->json(['success' => true, 'msg' => 'Registro existoso.']);
    }
    public function show(Request $request)
    {
        $Routine = Routine::find($id);
        return $Routine->toJson();
    }
    public function edit(Request $request)
    {
        $Routine = Routine::find($request->id);
        return $Routine->toJson();
    }
    public function update(Request $request)
    {
        $rule = new RoutineRequest();
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors()->all()]);
        } else {
            $Routine = Routine::find($request->id);
            $Routine->update($request->all());

            if ($request->image && $request->extension_image) {
                //Delete File
                Storage::disk('public')->delete($Routine->logo);
                $this->SaveFile($Routine, $request->image, $request->extension_image, '/images/Rutinas/');
            }

            return response()->json(['success' => true, 'msg' => 'Se actualizo existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $Routine = Routine::find($request->id);
        $Routine->estado = "ELIMINADO";
        $Routine->update();
        return response()->json(['success' => true, 'msg' => 'Registro borrado.']);
    }
    public function dt_products()
    {
        return datatables()->of(Product::where('estado', '!=', 'ELIMINADO')->with('user', 'type')->get())
            ->addColumn('Imagen', function ($item) {
                return '<img src="' . $item->foto . '" alt="logo" width="125px" onclick="window.open(\'' . $item->foto . '\');"></img>';
            })
            ->addColumn('Shop', function ($item) {
                $product = Product::find($item->product_id);
                return '<a class="btn btn-xs btn-success text-white" onclick="AddBasket(' . $item->id . ',\'' . $item->nombre . '\',\'' . $item->precio . '\',\'Sin especificar\')"><i class="icon-cart-plus"></i></a>';
            })
            ->rawColumns(['Imagen', 'Shop'])
            ->toJson();
    }
    public function dt_clients()
    {
        return datatables()->of(User::where('state', '!=', 'ELIMINADO')->where('state_rol', 'CLIENTE'))
            ->addColumn('SelectClient', function ($item) {
                return '<a class="btn btn-xs btn-success text-white" onclick="SelectClient(' . $item->id . ',\'' . $item->name . '\')"><i class="icon-ok-circled"></i></a>';
            })
            ->rawColumns(['SelectClient'])
            ->toJson();
    }
    public function dt_details(Request $request)
    {
        return datatables()->of(Detail::where('estado', '!=', 'ELIMINADO')->where('routine_id', $request->id)->with('product')->get())
        ->addColumn('Imagen', function ($item) {
            return '<img src="' . $item->product->foto . '" alt="logo" width="125px" onclick="window.open(\'' . $item->product->foto . '\');"></img>';
        })
        ->rawColumns(['Imagen'])
        ->toJson();
    }
    public function data_table()
    {
        //$isUser = auth()->user()->can(['provider.edit', 'provider.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        //if (!$isUser) {$visibility="disabled";}
        return datatables()->of(Routine::where('estado', '!=', 'ELIMINADO')->with('user')->get())
            ->addColumn('Detalles', function ($item) {
                
                return '<a class="btn btn-xs btn-info text-white ' . $item->v . '" onclick="Details(' . $item->id . ')" ><i class="icon-info"></i></a>';
            })
            ->addColumn('Editar', function ($item) {
                
                return '<a class="btn btn-xs btn-primary text-white ' . $item->v . '" onclick="Edit(' . $item->id . ')" ><i class="icon-pencil"></i></a>';
            })
            ->addColumn('Eliminar', function ($item) {
                
                return '<a class="btn btn-xs btn-danger text-white ' . $item->v . '" onclick="Delete(' . $item->id . ')" ><i class="icon-trash"></i></a>';
            })
            ->rawColumns(['Detalles', 'Editar', 'Eliminar'])
            ->toJson();
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
}
