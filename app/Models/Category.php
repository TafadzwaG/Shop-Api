<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image'
    ];


    public function product_categories(){
        return $this->hasMany(ProductCategory::class);
    }

    
}
