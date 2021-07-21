<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller

{   

    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show', 'getFeaturesProducts', 'getLatestProducts', 'getPerPage');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return  ProductCollection::collection(Product::all());

        
    }

    public function perPage(Request $request, $per_page){

        if($per_page > 20){
            return  ProductCollection::collection(Product::all());
        }
        return  ProductCollection::collection(Product::paginate($per_page));
    }

    

    public function getFeaturesProducts(){

        return  ProductResource::collection(Product::inRandomOrder()->limit(4)->get());
    }

    public function getLatestProducts(){
        return  ProductResource::collection(Product::latest()->limit(3)->get());
    }



    public function productFilter(){
        $products = Product::withFilters(
            request()->input('prices', []),
            request()->input('categories', []),
        )->get();

        return ProductResource::collection($products);
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
        $product_data = $request->validate([
            "name" => "required|string",
            "description" => "required|string",
            "price" => "required|numeric",
            "stock" => "required|numeric",
            "discount" => "nullable|numeric",
            "image" => "nullable|image:png:jpeg:jpg:gif"

        ]);

        if($request ->has("image")){
            $imageName = time()."update_image".".".$request->photo->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $data["image"] = $imageName;
        }
        $product = Product::create($product_data);
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new  ProductCollection($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
