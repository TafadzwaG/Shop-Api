<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'parent_id'
    ];


    

    public function products(){
        return $this->belongsToMany(Product::class, 'product_categories');
    }

    public function subcategory(){
        return $this->hasMany(Category::class, 'parent_id')->withCount('products');
    }

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function childrenRecursive(){
        return $this->subcategory()->with('childrenRecursive');
    }
}
