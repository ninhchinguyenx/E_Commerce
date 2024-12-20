<?php

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product_Gallery;
use App\Models\ProductGallery;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasTable('products')){
            Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('sku');
            $table->decimal('price_regular', 10, 2);
            $table->decimal('price_sale', 10, 2);
            $table->integer('quantity');
            $table->string('short_description')->nullable();
            $table->text('detailed_description')->nullable();
            $table->string('img_thumbnail')->nullable();
            $table->foreignIdFor(Category::class)->constrained();
            $table->foreignIdFor(ProductGallery::class)->constrained();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_hot_deal')->default(true);
            $table->boolean('is_good_deal')->default(true);
            $table->boolean('is_new')->default(true);
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
