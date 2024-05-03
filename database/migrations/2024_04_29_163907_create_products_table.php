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
            $table->bigIncrements('id');
            $table->string('sku');
            $table->bigInteger('product_category')->unsigned();
            $table->text('product_name');
            $table->text('product_detail');
            $table->bigInteger('product_brand')->unsigned();
            $table->integer('product_price');
            $table->string('fileimages', 255);
            $table->double('product_length');
            $table->double('product_width');
            $table->double('product_height');
            $table->double('product_weight');
            $table->string('status', 255);
            $table->enum('deleted', ['yes', 'no'])->default('no');
            $table->timestamps();
            $table->string('slug', 255);
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
