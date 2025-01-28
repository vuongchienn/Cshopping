<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function productComments(){
        return $this->hasMany(ProductComment::class);
    }
    public function productDetails(){
        return $this->hasMany(ProductDetail::class);
    }

    public function productImages(){
        return $this->hasMany(ProductImage::class);
    }
    
  


}
