<?php

namespace App\Http\Controllers;

use App\Presenter;
use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\DataTables;
use App\Http\Requests\PresenterRequest;
use Validator;
use Illuminate\Support\Facades\Storage;

class PresenterController extends Controller
{
    public function data_table()
    {
        //$isUser = auth()->user()->can(['provider.edit', 'provider.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        //if (!$isUser) {$visibility="disabled";}
            return datatables()->of(Presenter::where('estado','!=','ELIMINADO')->with('user')->get())

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
    public function index()
    {
        return view('content.presenters');
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $rule = new PresenterRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Presenter = Presenter::create($request->all());
            //IMAGE 
            if($request->image&&$request->extension_image){
                $this->SaveFile($Presenter,$request->image, $request->extension_image, '/images/Presenters/');
            }
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function update(Request $request)
    {
        $rule = new PresenterRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Presenter = Presenter::find($request->id);
            $Presenter->update($request->all());

            if($request->image&&$request->extension_image){
                //Delete File
                Storage::disk('public')->delete($Presenter->logo);
                $this->SaveFile($Presenter,$request->image, $request->extension_image, '/images/Presenters/');
            }
            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }
    public function SaveFile($obj,$code, $extension_file, $path)
    {
        $image = $code;
        switch ($extension_file) {
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
    public function destroy(Request $request)
    {
        $Presenter = Presenter::find($request->id);
        $Presenter->estado = "ELIMINADO";
        $Presenter->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
    public function show($id)
    {
        $Presenter = Presenter::find($id);
        return $Presenter->toJson();
    }
    public function edit(Request $request)
    {
        $Presenter = Presenter::find($request->id);
        return $Presenter->toJson();
    }  
}
