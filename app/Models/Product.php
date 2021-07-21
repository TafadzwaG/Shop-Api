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
        'discount',
        'category_id'

   ];



   const PRICES = [
    'Less than 50',
    'From 50 to 100',
    'From 100 to 500',
    'More than 500',
   ];

   public function getCategoryAttribute($value)
    {
        return explode(',', $value);
    }

    public function setCategoryAttribute($value)
    {
        $this->attributes['category_id'] = implode(',', $value);
    } 

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function product_images(){
        return $this->hasMany(ProductImage::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function scopeWithFilters($query, $prices, $categories){

        return $query->when(count($categories), function($query) use($categories){
            $query->whereIn('category_id', $categories);
        })
        ->when(count($prices), function($query) use($prices){
            $query->where(function($query) use($prices){
                $query->when(in_array(0, $prices), function($query){
                    $query->orWhere('price', '<', '100');
                })
                ->when(in_array(1, $prices), function($query){
                    $query->orWhereBetween('price', ['100', '500']);
                })
                ->when(in_array(2, $prices), function($query){
                    $query->orWhereBetween('price', ['500', '1000']);
                })
                ->when(in_array(3, $prices), function($query){
                    $query->orWhere('price', '>', '1000');
                });
            });
        });
    }

}
 