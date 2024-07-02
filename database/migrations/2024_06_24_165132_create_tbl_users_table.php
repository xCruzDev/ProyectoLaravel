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
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->id('idx')->autoincrement();
            $table->string('usuario',20);
            $table->string('nombre',20);
            $table->string('sexo',1);
            $table->tinyInteger('nivel');
            $table->string('email',50);
            $table->string('telefono',20);
            $table->string('marca',20);
            $table->string('compania',20);
            $table->double('saldo');
            $table->boolean('activo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_users');
    }
};
