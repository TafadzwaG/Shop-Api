<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = auth()->user()->cart;
        return  new CartResource($cart);
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
       if(auth()->user()->cart){
           return response(['message' => 'Already have a cart'], $status = 500);
       } 

       $cart = Cart::create([
            'user_id' => auth()->user()->id
       ]);

       return response([
            'message' => 'A new cart have been created for you!',
            'cart'    => new CartResource($cart)
       ], $status = 201);
    }

    public function addCartItems(Request $request, Cart $cart){

        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1'
        ]);

        if($validator->fails()){
            return \response([
                'message' => 'Validation Error',
            ], $status = 500);
        }

        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cartItem = CartItem::where([
            'cart_id' => $cart->id,
            'product_id' => $product_id 
            ])->first();


        if($cartItem){
            $cartItem->quantity = $cartItem->quantity + $quantity;
            $cartItem->save();
        }else {
            CartItem::create([
                'cart_id' => $cart->id, 
                'product_id' => $product_id, 
                'quantity' => $quantity
            ]);
        }

        return new CartResource($cart);
    }

    public function checkout(Cart $cart, Request $request) {
        $data = $request->validate([
            'total' => 'required | numeric',
            'status' => 'required',
            'mobile'=> 'required',
            'phone_number'=> 'required',
            'method' => 'required'
        ]);

        
        // $transaction = $this->initiateTransaction($data["total"], "order", $data["mobile"], $data["phone_number"], $data["method"]);

        /**
             * Credit Card information should be sent to a payment gateway for processing and validation,
             * the response should be dealt with here, but since this is a dummy project we'll
             * just assume that the information is sent and the payment process was done succefully,
             */

            // if($transaction === null){
            //     return $this->jsonError("Problem connecting to the PSP",500);
            // }else if($transaction instanceof Transaction){

                
            //     $order = Order::create([
            //         'items' => json_encode(new CartItemCollection($cart->items)),
            //         'total' => $data['total'],
            //         'status' => $data['status'],
            //         'user_id' => auth()->user()->id,
            //         'transaction_id' => $transaction->id,
            //         'cart_id' => $cart->id
            //     ]);

               
            //     return new OrderResource($order);
            // }else if ($transaction instanceof ConnectionException) {
            //     return $this->jsonError("Could Not Connect Try Agin",500);
            // }else{
            //     return $this->jsonError("Could Not Connect Try Again",500);
            // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function removeCartItem(CartItem $cartItem){

        if($cartItem->delete()){
            return response([
                'message' => 'Item Removed',
                $status = 200,
            ]);
        }

        return response([
            'message' => 'Error While Removing Item',
            $status = 500
        ]);
    }
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        if($cart->delete()){
            return response([
                'message' => 'Cart Deleted',
                $status = 200
            ]);
        }

        return response([
            'message' => "error while deleting cart",
            $status = 500 
        ]);

    }
}
