<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'sku', 'price', 'price_sale', 'quantity', 
    'short_description', 'detailed_description', 'img_thumbnail', 
    'category_id', 'product_gallery_id', 'is_active', 'is_hot_deal', 'is_good_deal', 'is_new'];
    
    protected $casts = ['is_active' => 'boolean', 'is_hot_deal' => 'boolean', 'is_good_deal' => 'boolean', 'is_new' => 'boolean'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function productGallery(){
        return $this->belongsTo(ProductGallery::class);
    }
}
