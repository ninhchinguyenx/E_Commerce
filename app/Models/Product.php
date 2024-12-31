<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'sku', 'price_regular', 'price_sale', 'quantity', 
    'short_description', 'detailed_description', 'img_thumbnail', 
    'category_id', 'is_active', 'is_hot_deal', 'is_good_deal', 'is_new'];
    
    protected $casts = ['is_active' => 'boolean', 'is_hot_deal' => 'boolean', 'is_good_deal' => 'boolean', 'is_new' => 'boolean'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function product_gallery(){
        return $this->hasMany(ProductGallery::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
