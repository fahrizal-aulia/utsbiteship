<?php

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
        Schema::create('products', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->char('sku', 255);
            $table->unsignedBigInteger('product_category');
            $table->string('prodct_name');
            $table->string('prodct_detail');
            $table->unsignedBigInteger('product_brand');
            $table->integer('product_price');
            $table->string('image')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
