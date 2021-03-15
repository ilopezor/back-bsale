<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductoController extends Controller
{
    //

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
