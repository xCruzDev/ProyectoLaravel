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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->unsignedBigInteger('client_id');
            $table->string('street',50);
            $table->integer('number_ext');
            $table->integer('zip_code');
            $table->string('city',50);
            $table->string('country',50);
            $table->enum('principal',['Y','N']);
            $table->foreign('client_id')
            ->references('id')
            ->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
