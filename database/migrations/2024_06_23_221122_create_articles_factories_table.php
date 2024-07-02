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
        Schema::create('articles_factories', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('factory_id');
            $table->integer('amount');

            $table->foreign('article_id')
                ->references('id')
                ->on('articles');

            $table->foreign('factory_id')
                ->references('id')
                ->on('factories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles_factories');
    }
};
