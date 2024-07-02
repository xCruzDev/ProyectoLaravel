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
        Schema::create('clients', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->string('user_name',20);
            $table->string('name',35);
            $table->string('last_name',30);
            $table->double('balance',12,2);
            $table->double('credit_limit',12,2);
            $table->double('discount',12,2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
