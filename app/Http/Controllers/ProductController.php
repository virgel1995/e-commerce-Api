<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductNotBelongsToUser;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }


    public function index()
    {
        return  ProductCollection::collection(Product::paginate(5));
    }

    public function create()
    {
        //
    }


    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->detail = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->discount = $request->discount;
        $product->user_id = $request->user_id;
        $product->save();
        return response([
            'message' => 'Product Created Successfully',
            'data' => new ProductResource($product),
        ], Response::HTTP_CREATED);
    }


    public function show(Product $product)
    {
          return new ProductResource($product);
    }


    public function edit(Product $product)
    {
        //
    }


    public function update(Request $request, Product $product)
    {
        $this->productUserCheck($product);
        $request['detail'] = $request->description;
        unset($request['description']);
        $product->update($request->all());
        return response([
            'message' => 'Product Updated Successfully',
            'data' => new ProductResource($product),
        ], Response::HTTP_CREATED);
    }

    public function destroy(Product $product)
    {
        $this->productUserCheck($product);
        $product->delete();
        return response([
            'message' => 'Product Deleted Successfully',
        ], Response::HTTP_OK);
    }

    public function productUserCheck($product){
        if(auth()->id() !== $product->user_id){
            throw new ProductNotBelongsToUser;
        }
    }
}

