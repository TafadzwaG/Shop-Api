<?php

namespace App\Http\Controllers;

use App\Http\Resources\BannerAdResource;
use App\Models\BannerAd;
use Illuminate\Http\Request;

class BannerAdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  BannerAdResource::collection(BannerAd::inRandomOrder()->limit(3)->get());
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
            'title' => 'required| string',
            'description' => 'required|string',
            'percentage_off' => 'required|numeric',
            'image' => "nullable|image:png:jpeg:jpg:gif",
            'starting_at' => 'required|date',

        ]);

        if($request ->has("image")){
            $imageName = time()."update_image".".".$request->photo->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $data["image"] = $imageName;
        }

        $banner_ad = BannerAd::create($data);

        return new BannerAdResource($banner_ad);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BannerAd  $bannerAd
     * @return \Illuminate\Http\Response
     */
    public function show(BannerAd $bannerAd)
    {
        return new BannerAdResource($bannerAd);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BannerAd  $bannerAd
     * @return \Illuminate\Http\Response
     */
    public function edit(BannerAd $bannerAd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BannerAd  $bannerAd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BannerAd $bannerAd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BannerAd  $bannerAd
     * @return \Illuminate\Http\Response
     */
    public function destroy(BannerAd $bannerAd)
    {
        //
    }
}
