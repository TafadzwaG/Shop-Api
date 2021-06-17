<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $casts = [
        'posted_at' => 'datetime:Y-m-d',
    ];
    protected $fillable = [
        
        'title',
        'sub_title',
        'tag',
        'posted_at',
        'body',
        'posted_by',
    ];


    public function blog_images(){
        return $this->hasMany(BlogImage::class);
    }
}
