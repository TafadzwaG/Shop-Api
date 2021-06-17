<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

	protected $fillable = [
		'cart_id',
		'status',
		'items',
		'user_id',
		'transaction_id',
		'total'
	];

	public function transaction(){
		return $this->belongsTo(Transaction::class);
	}

	public function cart(){
		return $this->belongsTo(Cart::class);
	}

	public function items(){
		return $this->hasMany(OrderItems::class);
	}
}
