<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Http\Resources\ReviewResource;
use Illuminate\Http\Request;
 
class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
    
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {

        
            return ReviewResource::collection(Review::latest()->limit(3)->get());
            

            
         
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
    public function store(Request $request)
    {
        $data_reviews = $request->validate([
            'product_id' => 'required  | numeric',
            "name" => "required| string",
            "star" => "required| numeric",
            "review_title" => "required | string",
            "email" => "required| email",
            "review" => "required|string",
        ]);

        $review = Review::create($data_reviews);
        return new ReviewResource($review);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
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
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
