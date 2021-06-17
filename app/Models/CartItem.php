<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable =[
        "id",
        "product_id",
        "cart_id",
        "quantity"
    ];

    protected $with= ["product"];

    public function cart(){
        $this->belongsTo(Cart::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
