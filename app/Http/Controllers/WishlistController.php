<?php

namespace App\Http\Controllers;

use App\Http\Resources\WishlistResource;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlist = auth()->user()->wishlist;
        return new WishlistResource($wishlist);
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
        if(auth()->user()->wishlist){
            return response(['message' => 'Already have a wishlist'], $status = 500);
        } 
 
        $wishlist = Wishlist::create([
             'user_id' => auth()->user()->id
        ]);
 
        return response([
             'message' => 'A new wishlist have been created for you!',
             'wishlist'    => new WishlistResource($wishlist)
        ], $status = 201);
    }

    public function addWishlistItems(Request $request, Wishlist $wishlist){
       
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
        ]);

        if($validator->fails()){
            return response([
                'message' => 'Validation Error',
            ], $status = 500);
        }

        $product_id = $request->input('product_id');

        $wishlistItem = WishlistItem::where([
            'wishlist_id' => $wishlist->id,
            'product_id' => $product_id
        ])->first();

        if($wishlistItem){
            $wishlistItem->save();
        }else{
            WishlistItem::create([
                'wishlist_id' => $wishlist->id,
                'product_id' => $product_id,
            ]);
        }


        return new WishlistResource($wishlist);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        if($wishlist->delete()){
            return response([
                'message' => 'Wishlist deleted'
            ],$status=200 );
        }
        return response([
            'message' => 'Error while deleting'
        ], $status = 500);
    }
}
