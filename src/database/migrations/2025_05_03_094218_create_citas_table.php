<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //las migraciones crean las tablas que son citas y users
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained('users')->onDelete('cascade');
            $table->string('marca');
            $table->string('modelo');
            $table->string('matricula');
            $table->time('fecha')->nullable(); //el taller asignara la fecha y hora
            $table->time('hora')->nullable();//el taller asignara la fecha y hora
            $table->time('duracion')->nullable();//el taller asignara la duracion
            $table->timestamps();

        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
