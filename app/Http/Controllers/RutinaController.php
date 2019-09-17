<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Routine;
use Yajra\DataTables\DataTables;
use App\Http\Requests\RoutineRequest;
use Illuminate\Support\Facades\Storage;

class RutinaController extends Controller
{

    public function index()
    {
        return view('content.routine');
    }
    public function store(Request $request)
    {
        $rule = new RoutineRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Routine = Routine::create($request->all());
            //IMAGE 
            if($request->image&&$request->extension_image){
                $image = $request->image;
                $this->SaveFile($Routine,$request->image, $request->extension_image, '/images/Rutinas/');
            }

            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
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
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Routine = Routine::find($request->id);
            $Routine->update($request->all());

            if($request->image&&$request->extension_image){
                //Delete File
                Storage::disk('public')->delete($Routine->logo);
                $this->SaveFile($Routine,$request->image, $request->extension_image, '/images/Rutinas/');
            }

            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $Routine = Routine::find($request->id);
        $Routine->estado = "ELIMINADO";
        $Routine->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
    public function data_table()
    {
        //$isUser = auth()->user()->can(['provider.edit', 'provider.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        //if (!$isUser) {$visibility="disabled";}
            return datatables()->of(Routine::where('estado','!=','ELIMINADO')->with('user')->get())
            ->addColumn('Imagen', function ($item) use ($visibility) {
                $item->v=$visibility;
            return '<img src="'.$item->foto.'" alt="logo" width="125px" onclick="window.open(\''.$item->foto.'\');"></img>';
            })
            ->addColumn('Editar', function ($item) use ($visibility) {
                $item->v=$visibility;
            return '<a class="btn btn-xs btn-primary text-white '.$item->v.'" onclick="Edit('.$item->id.')" ><i class="icon-pencil"></i></a>';
            })
            ->addColumn('Eliminar', function ($item) use ($visibility) {
                $item->v=$visibility;
            return '<a class="btn btn-xs btn-danger text-white '.$item->v.'" onclick="Delete('.$item->id.')" ><i class="icon-trash"></i></a>';
            })
            ->rawColumns(['Editar','Eliminar','Imagen']) 
            ->toJson();   
    }
    public function SaveFile($obj,$code, $extension_file, $path)
    {
        $image = $code;
        switch ($extension_file) {
            case 'jpg':            
                $image = str_replace('data:image/jpeg;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageURL = $path.str_random(10).$obj->id.'.jpg';
                Storage::disk('public')->put($imageURL,  base64_decode($image));
                $obj->foto = $imageURL;
                $obj->save();
                return response()->json(['success'=>true,'msg'=>'Registro existoso']);
                break;
            case 'png':            
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageURL = $path.str_random(10).$obj->id.'.png';
                Storage::disk('public')->put($imageURL,  base64_decode($image));
                $obj->foto = $imageURL;
                $obj->save();
                return response()->json(['success'=>true,'msg'=>'Registro existoso']);
                break;
            case 'gif':
                $image = str_replace('data:image/gif;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageURL = $path.str_random(10).$obj->id.'.gif';
                Storage::disk('public')->put($imageURL,  base64_decode($image));
                $obj->foto = $imageURL;
                $obj->save();
                return response()->json(['success'=>true,'msg'=>'Registro existoso asdasd']);
                break;                                                
            default:
                return response()->json(['success'=>false,'msg'=>'Registro existoso, imágen no aceptada solo esta permitido imágenes JPG, GIF ó PNG.']);
                break;
        }
    }
}
