<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    
    
    public function cartUsers()
        {
            return $this->belongsToMany(User::class, 'carts')
                        ->withPivot('quantity')
                        ->withTimestamps();
        }

    public function carts()
        {
            return $this->hasMany(Cart::class);
        }


    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }
}
