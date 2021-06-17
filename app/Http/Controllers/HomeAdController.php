<?php

namespace App\Http\Controllers;

use App\Http\Resources\HomeAdResource;
use App\Models\HomeAd;
use Illuminate\Http\Request;

class HomeAdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  HomeAdResource::collection(HomeAd::inRandomOrder()->limit(3)->get());
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
        $data = $request-> validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => "nullable|image:png:jpeg:jpg:gif",
            'was' => 'required|numeric',
            'is_now' => 'required|numeric',
            'simple' => 'required|boolean'

        ]);

        if($request ->has("image")){
            $imageName = time()."update_image".".".$request->photo->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $data["image"] = $imageName;
        }

        $home_ad = HomeAd::create($data);

        return new HomeAdResource($home_ad);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HomeAd  $homeAd
     * @return \Illuminate\Http\Response
     */
    public function show(HomeAd $homeAd)
    {
        return new HomeAdResource($homeAd);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeAd  $homeAd
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeAd $homeAd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HomeAd  $homeAd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeAd $homeAd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeAd  $homeAd
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeAd $homeAd)
    {
        //
    }
}
