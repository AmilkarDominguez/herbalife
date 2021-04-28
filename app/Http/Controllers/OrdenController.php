<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Order;
use Yajra\DataTables\DataTables;
use App\Http\Requests\OrderRequest;
use Validator;

class OrdenController extends Controller
{
    public function index()
    {
        return view('content.order');
    }

    public function store(Request $request)
    {
        $rule = new OrderRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Order = Order::create($request->all());
            //IMAGE 
            if($request->image&&$request->extension_image){
                $image = $request->image;
                $this->SaveFile($Order,$request->image, $request->extension_image, '/images/Orderos/');
            }

            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function update(Request $request)
    {
        $rule = new OrderRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Order = Order::find($request->id);
            $Order->update($request->all());

            // if($request->image&&$request->extension_image){
            //     //Delete File
            //     Storage::disk('public')->delete($Order->image);
            //     $this->SaveFile($Order,$request->image, $request->extension_image, '/images/Orderos/');
            //     //return response()->json(['success'=>true,'msg'=>$request->extension_image]);
            // }

            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }
    public function show(Request $request)
    {
        $Order = Order::find($id);
        return $Order->toJson();
    }
    public function edit(Request $request)
    {
        $Order = Order::find($request->id);
        return $Order->toJson();
    }


    public function destroy(Request $request)
    {
        $Order = Order::find($request->id);
        $Order->estado = "ELIMINADO";
        $Order->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }

    //METODOS

    public function data_table()
    {
        //$isUser = auth()->user()->can(['provider.edit', 'provider.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        //if (!$isUser) {$visibility="disabled";}
            return datatables()->of(Order::where('estado','!=','ELIMINADO')->with('user')->get())
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
