<?php

use App\Models\Product;
use App\Models\User;
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
        if(!Schema::hasTable('reviews')){
            Schema::create('reviews', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(User::class)->constrained();
                $table->foreignIdFor(Product::class)->constrained();
                $table->integer('rating')->default(0);
                $table->text('comment')->nullable();
                $table->boolean('is_active')->default(false);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
