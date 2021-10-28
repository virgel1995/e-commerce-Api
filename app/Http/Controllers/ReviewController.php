<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Review\ReviewResource;
use Illuminate\Http\Response;

class ReviewController extends Controller
{


    public function index(Product $product)
    {
        // return $product->reviews;
        return ReviewResource::collection($product->reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request, Product $product)
    {
        $review = new Review($request->all());
        $product->reviews()->save($review);
        return response([
            'message' => 'Review Added Successfully',
            'data' => new ReviewResource($review),
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product , Review $review)
    {
         $review->update($request->all());
         return response([
            'message' => 'Review Updated Successfully',
            'data' => new ReviewResource($review),
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product , Review $review)
    {
        $review->delete();
        return response([
            'message' => 'Review Deleted Successfully',
        ], Response::HTTP_OK);
    }
}
