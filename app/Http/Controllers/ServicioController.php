<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use Validator;
use App\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ServiceRequest;

class ServicioController extends Controller
{
    public function index()
    {
        return view('content.servicio');
    }
    public function store(Request $request)
    {
        $rule = new ServiceRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Service = Service::create($request->all());
            //IMAGE 
            if($request->image&&$request->extension_image){
                $image = $request->image;
                $this->SaveFile($Service,$request->image, $request->extension_image, '/images/Servicio/');
            }

            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function show(Request $request)
    {
        $Service = Service::find($id);
        return $Service->toJson();
    }
    public function edit(Request $request)
    {
        $Service = Service::find($request->id);
        return $Service->toJson();
    }
    public function update(Request $request)
    {
        $rule = new ServiceRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Service = Service::find($request->id);
            $Service->update($request->all());

            if($request->image&&$request->extension_image){
                //Delete File
                Storage::disk('public')->delete($Service->logo);
                $this->SaveFile($Service,$request->image, $request->extension_image, '/images/Servicio/');
            }

            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $Service = Service::find($request->id);
        $Service->estado = "ELIMINADO";
        $Service->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
    public function data_table()
    {
        //$isUser = auth()->user()->can(['provider.edit', 'provider.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        //if (!$isUser) {$visibility="disabled";}
            return datatables()->of(Service::where('estado','!=','ELIMINADO')->with('user')->get())
            ->addColumn('Imagen', function ($item) use ($visibility) {
                $item->v=$visibility;
            return '<img src="'.$item->logo.'" alt="logo" width="125px" onclick="window.open(\''.$item->logo.'\');"></img>';
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
                $obj->logo = $imageURL;
                $obj->save();
                return response()->json(['success'=>true,'msg'=>'Registro existoso']);
                break;
            case 'png':            
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageURL = $path.str_random(10).$obj->id.'.png';
                Storage::disk('public')->put($imageURL,  base64_decode($image));
                $obj->logo = $imageURL;
                $obj->save();
                return response()->json(['success'=>true,'msg'=>'Registro existoso']);
                break;
            case 'gif':
                $image = str_replace('data:image/gif;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageURL = $path.str_random(10).$obj->id.'.gif';
                Storage::disk('public')->put($imageURL,  base64_decode($image));
                $obj->logo = $imageURL;
                $obj->save();
                return response()->json(['success'=>true,'msg'=>'Registro existoso asdasd']);
                break;                                                
            default:
                return response()->json(['success'=>false,'msg'=>'Registro existoso, imágen no aceptada solo esta permitido imágenes JPG, GIF ó PNG.']);
                break;
        }
    }
}
