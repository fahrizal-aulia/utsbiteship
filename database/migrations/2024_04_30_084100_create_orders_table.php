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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomerorder', 25);
            $table->bigInteger('iduser')->unsigned();
            $table->string('status', 255);
            $table->integer('itemsub_total');
            $table->integer('tax');
            $table->integer('shipping_price');
            $table->integer('ordertotal');
            $table->integer('payment');
            $table->string('pengiriman', 255);
            $table->string('namalengkap', 255);
            $table->string('firstname', 255);
            $table->string('lastname', 255);
            $table->string('negara', 255);
            $table->string('provinsi', 255);
            $table->string('kota', 255);
            $table->string('kecamatan', 255);
            $table->text('alamat');
            $table->string('kodepos', 255);
            $table->string('email', 255);
            $table->string('phone', 255);
            $table->text('addcatatan');
            $table->string('payment_id', 11);
            $table->string('payment_method', 255);
            $table->string('payment_status', 255);
            $table->string('tracking_number', 255);
            $table->enum('deleted', ['yes', 'no']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
