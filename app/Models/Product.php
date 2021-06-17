<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = [

        'name',
        'description',
        'stock',
        'price',
        'discount'

   ];

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function product_images(){
        return $this->hasMany(ProductImage::class);
    }

    public function product_category(){
        return $this->belongsToMany(ProductCategory::class);
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }
}
 