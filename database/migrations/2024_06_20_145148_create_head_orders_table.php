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
        Schema::create('head_orders', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->unsignedBigInteger('client');
            $table->unsignedBigInteger('address');
            $table->date('order_date');
            $table->double('discount',12,2);
            $table->double('total',12,2);

            $table->foreign('client')
                ->references('id')
                ->on('clients');

            $table->foreign('address')
                ->references('id')
                ->on('addresses');                
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('head_orders');
    }
};
