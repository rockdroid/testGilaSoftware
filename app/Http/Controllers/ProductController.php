<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers;

use App\Product;
use App\productCharacteristic;
use App\productType;

class ProductController extends Controller
{
    public function types()
    {
        $types = productType::get();

        return Helpers::resp(200, 'SUCCESS', $types);
    }

    public function chars()
    {
        $chars = productCharacteristic::get();

        return Helpers::resp(200, 'SUCCESS', $chars);
    }

    //
    public function index()
    {
        $products = Product::with('type')->with('charactetistics')->get();

        return Helpers::resp(200, 'SUCCESS', $products);
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request['name'];
        $product->sku = $request['sku'];
        $product->brand = $request['brand'];
        $product->cost = $request['cost'];
        $product->finalPrice = $request['finalPrice'];
        $product->size = $request['size'];
        $product->product_type_id = $request['product_type_id'];
        $product->product_characteristic_id = $request['product_characteristic_id'];

        $product->save();
        $id = $product->id;

        return Helpers::resp(200, 'SUCCESS', $id);
    }

    public function destroy(Request $request)
    {
        dd($request->all());
        $productId = $request['id'];

        $product = new Product();
        $product::find($productId);
        $product->delete();

        return Helpers::resp(200, 'SUCCESS', $productId);
    }

}
