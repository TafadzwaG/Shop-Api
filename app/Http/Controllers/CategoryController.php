<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return CategoryResource::collection(Category::all());
        // $categories = Category::whereNull('parent_id')->get();
        // return CategoryResource::collection($categories);

        //Getting all the parents
        $categoriesParents = Category::with('subcategory.subcategory.subcategory')->withCount('products')->whereNull('parent_id')->get();
        return CategoryResource::collection($categoriesParents);
    }


    public function getSingleCategory(Request $request, $name){

        $categories = Category::where('name', $name )->with('childrenRecursive')->get();
        return CategoryResource::collection($categories);
    }


    public function getAllCategories(){

        //Returning all Children and grand children of categoriries
        $categoriesChildren = Category::whereNotNull('parent_id')->get();
        return CategoryResource::collection($categoriesChildren );

    }


    public function categoryFilter(){
        $categories = Category::withCount(['products' => function($query){
            $query->withFilters(
                request()->input('prices', []),
                request()->input('categories', [])
            );
        }])
        ->get();
        return CategoryResource::collection($categories);
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
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => "nullable|image:png:jpeg:jpg:gif",
            'parent_id' => 'nullable|numeric'
        ]);

        if($request ->has("image")){
            $imageName = time()."update_image".".".$request->photo->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $data["image"] = $imageName;
        }

        $category = Category::create($data);
        return new CategoryResource( $category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
