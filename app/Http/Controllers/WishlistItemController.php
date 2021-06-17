<?php

namespace App\Http\Controllers;

use App\Models\WishlistItem;
use Illuminate\Http\Request;

class WishlistItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WishlistItem  $wishlistItem
     * @return \Illuminate\Http\Response
     */
    public function show(WishlistItem $wishlistItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WishlistItem  $wishlistItem
     * @return \Illuminate\Http\Response
     */
    public function edit(WishlistItem $wishlistItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WishlistItem  $wishlistItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WishlistItem $wishlistItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WishlistItem  $wishlistItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(WishlistItem $wishlistItem)
    {
        if($wishlistItem->delete()){
            return response([
                'message' => 'Item deleted',
                $status = 200,
            ]);
        }

        return response([
            'message' => 'Error while deleting',
            $status = 500
        ]);
    }
}
