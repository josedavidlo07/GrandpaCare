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
        Schema::create('salud', function (Blueprint $table) {
        $table->id();
        $table->float('presion_arterial');
        $table->float('glucosa');
        $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
        $table->timestamp('fecha');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salud');
    }
};
