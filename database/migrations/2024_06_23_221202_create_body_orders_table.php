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
        Schema::create('body_orders', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('article_id');
            $table->integer('article_amount');

            $table->foreign('order_id')
                ->references('id')
                ->on('head_orders');

            $table->foreign('article_id')
                ->references('id')
                ->on('articles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('body_orders');
    }
};
