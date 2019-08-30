<?php

namespace App\Http\Controllers;

use App\Exceptions\UnAuthorizedUserException;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Model\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class ProductController extends BaseController
{
    public function _construct(){
        $this->middleware('auth:api')->except('index','show');
    }

    public function index()
    {
        $data = ProductCollection::collection(Product::paginate(3))->appends(request()->query());

      //  return ProductCollection::collection(Product::paginate(3));
        return $this->sendResponse($data,"DATA FOUND");
    }

    public function create()
    {
        //
    }

    public function store(ProductRequest $request)
    {

        try{

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->discount = $request->discount;
        $product->user_id = auth('api')->user()->id;
        $product->save();

        return $this->sendResponse(new ProductResource($product),'DATA SAVED');}
        catch (Exception $e){
            return $this->sendError('ERROR : ',$e->getMessage());

        }

        return$this->sendError('ERROR : ','NO DATA FOUND');


        return response(['data' => new ProductResource($product)],Response::HTTP_CREATED);
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
        $this->checkUser($product);
        $product-> update($request->all());

        return response(['data' => new ProductResource($product)],Response::HTTP_CREATED);
    }

    public function destroy(Product $product)
    {
        $this->checkUser($product);
        $product->delete();
        return response(null,Response::HTTP_NO_CONTENT);

    }

    public function checkUser($product){
        if($product->user_id !== auth('api')->user()->id){
            throw new UnAuthorizedUserException;
        }
    }
}
