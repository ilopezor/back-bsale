<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductoController extends Controller
{
    /*
    Este function de controlador tiene como objetivo extraer la data de la Base de Datos y 
    retornarla en forma de json para el uso de esta desde el front.
    Tiene como variable: 
    $item: Esta variable guarda cada una de las categorias que hay en la tabla product.
    $data: Me guarda toda la data final que se retorna al front.
    $category: Guarda la categoria de turno en el foreach.
    $product: Guarda los product que tengas en comun la categoria en turno en el foreach.
    $result: Variable que me permite organizar la data de forma correcta.
    */

    public function getProductCategory(){
        $item = Product::from('product')
        ->select('category')
        ->distinct()
        ->get();
        $data = [];
        foreach ($item as $key => $value) {
            # code...
            $category = Category::find($value->category);
            $product = Product::where('category',$value->category)
            ->get();
            $result = [
                'category'=>$category,
                'product'=>$product
            ];
            array_push($data,$result);
        }
        $response = [
            'success' => true,
            'data' => $data,
        ];
        return response()->json($response, 200);
    }
}
