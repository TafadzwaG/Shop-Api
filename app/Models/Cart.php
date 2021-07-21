<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    protected $hidden = [
      'created_at',
      'updated_at',
    ];

	protected $fillable = [
		"user_id"
	];

	protected $with = ["items"];

    public function items(){
        return $this->hasMany(CartItem::class);
    }

    
}
