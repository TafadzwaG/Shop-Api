<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api')->except('index', 'show');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BlogResource::collection(Blog::paginate(3));
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
        $blog_data = $request->validate([
            'title' => 'required|string',
            'sub_title' => 'required|string',
            'tag' => 'required|string',
            'body' => 'required|string',
            'posted_at' => 'required|date',
            'posted_by' => 'required|string'
        ]);


        $blog_post = Blog::create($blog_data);
        return new BlogResource($blog_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return new BlogResource($blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        

            $blog = Blog::findOrFail($blog->id);

    
            $this->validate($request,[
                'title' => 'required|string',
                'sub_title' => 'required|string',
                'tag' => 'required|string',
                'body' => 'required|string',
                'posted_at' => 'required|date',
                'posted_by' => 'required|string'
            ]);
    
            if($blog->id){
                $blog->title = $request->title;
                $blog->sub_title = $request->sub_title;
                $blog->tag = $request->tag;
                $blog->body = $request->body;
                $blog->posted_at = $request->posted_at;
                $blog->posted_by = $request->posted_by;
                $blog->save();

                return response([
                    'message' => 'Blog Post Updated',
                    'updated_blog_post' => new BlogResource(Blog::findOrFail($blog->id))
                ], $status =  200);
                
            }
    
            else{

                return response(['message' => 'Blog Not Found'], $status =  401);
            }
        
          
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if($blog->delete()){
            return response(['message' => 'blog post deleted'], $status =  200);
        }
        return response(['message' => 'error while deleting'], $status =  500);
    }
}
