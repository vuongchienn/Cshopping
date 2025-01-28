<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = ['product_detail_id','order_id','id' ,'quantity','total','amount'];

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function productDetail() {
        return $this->belongsTo(ProductDetail::class,'product_detail_id');
    }
}
