<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogImageResource;
use App\Models\BlogImage;
use Illuminate\Http\Request;

class BlogImageController extends Controller
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
        $image_data = $request->validate([
            "image" => "nullable|image:png:jpeg:jpg:gif"
        ]);

        if($request ->has("image")){
            $imageName = time()."update_image".".".$request->photo->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $data["image"] = $imageName;
        }

        $blog_image = BlogImage::create( $image_data);
        return new BlogImageResource($blog_image);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogImage  $blogImage
     * @return \Illuminate\Http\Response
     */
    public function show(BlogImage $blogImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogImage  $blogImage
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogImage $blogImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogImage  $blogImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogImage $blogImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogImage  $blogImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogImage $blogImage)
    {
        //
    }
}
