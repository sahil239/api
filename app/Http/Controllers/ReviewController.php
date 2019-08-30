<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Model\Product;
use App\Model\Review;
use Illuminate\Http\Request;
use Auth;

class ReviewController extends BaseController
{

    public function index(Product $product)
    {
        return ReviewResource::collection($product->reviews);
    }

    public function create()
    {
        //
    }

    public function store(ReviewRequest $request, Product $product)
    {

        try {
            $review = new Review($request->all());
            $product->reviews()->save($review);

            return $this->sendResponse($review, 'Data saved');

        }catch (Exception $e){
            return$this->sendError('ERROR : ','NO DATA FOUND');
        }
    }

    public function show(Review $review)
    {
        //
    }


    public function edit(Review $review)
    {
        //
    }


    public function update(Request $request, Review $review)
    {
        //
    }

    public function destroy(Review $review)
    {
        //
    }
}
