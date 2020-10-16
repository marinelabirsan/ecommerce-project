<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'product_category_id', 'product_provider_id', 'year', 'capacity', 'currency', 'type', 'price'];
    
    public function category()
    {
        return $this->belongsTo('App\ProductCategory' , 'product_category_id');
    }
    
    public function provider()
    {
        return $this->belongsTo('App\ProductProvider', 'product_provider_id');
    }
}
