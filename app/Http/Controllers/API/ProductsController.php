<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\Product;
use App\Type;

class ProductsController extends Controller
{

    public function list()
    {
        return Product::where('estado', 'ACTIVO')->with('user', 'type')->get();
    }
    public function list_JSON()
    {
        return Product::where('estado', 'ACTIVO')->with('user', 'type')->get()->toJson();
    }

    public function register_order(Request $request)
    {
        // user_id
        // nombre
        // foto
        // presentacion
        // precio
        // cantidad
        // tipo
        // estado
        $product = Product::find($request->product_id);
        $tipo = Type::find($product->type_id);
        $Order = Order::create([
            'user_id' => $request->user_id,

            'nombre' => $product->nombre,
            'foto' => $product->foto,
            'presentacion' => $product->presentacion,
            'precio' => $product->precio,
            'cantidad' => $request->cantidad,
            'tipo' => $tipo->nombre
        ]);
    

        return response()->json(['success' => true, 'msg' => 'Reserva registrada.']);
    }
}
