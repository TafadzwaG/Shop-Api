<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model
{
    protected $fillable = [
        "id",
        "product_id",
        "wishlist_id",
      ];
    
    protected $with = ['product'];
    
    public function wishlist(){
        $this->belongsTo(Wishlist::class);
    }
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
