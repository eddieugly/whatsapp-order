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
            $table->id();
            $table->ulid('ulid')->unique();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('amount')->unsigned();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone');
            $table->json('cart');
            $table->string('addon')->nullable();
            $table->string('tx_ref')->nullable();
            $table->tinyInteger('payment_method')->comment('0 => pay on pickup, 1 => pay now');
            $table->tinyInteger('payment_status')->comment('0 => failed, 1 => pending, 2 => paid');
            $table->tinyInteger('order_status')->default(1)->comment('0: cancelled, 1: pending, 2: completed, 3: picked');
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
