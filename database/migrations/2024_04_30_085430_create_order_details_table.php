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
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomerorder', 25);
            $table->bigInteger('idproduct')->unsigned();
            $table->integer('hargaproduk');
            $table->integer('qty');
            $table->integer('subtotalproduk');
            $table->text('note')->nullable();
            $table->string('review', 255)->nullable();
            $table->string('status', 255);
            $table->enum('deleted', ['yes', 'no'])->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
