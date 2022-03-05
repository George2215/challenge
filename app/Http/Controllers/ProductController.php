<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use Exception;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function store(ProductStoreRequest $request)
    {
        try{
            DB::beginTransaction();
            Product::create($request->all());

            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            $e->getMessage();
        }

        return back()->with('message', 'Producto creado exitosamente!');
    }
    
    public function getFinalPriceProduct()
    {
        $price = 1000000;
        $products = Product::get();

        foreach($products as $product){
            if($product->price > $price)
            $arrayNames [] = $product->name;
        }

        return view('welcome')->with('arrayNames', $arrayNames);
    }
}
