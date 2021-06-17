<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAd extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'was',
        'is',
        'simple'
    ];
}
