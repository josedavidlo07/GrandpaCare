<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('salud_registros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->smallInteger('presion_sistolica')->nullable();   // ej. 120
            $table->smallInteger('presion_diastolica')->nullable();  // ej. 80
            $table->smallInteger('glucosa_mg_dl')->nullable();       // ej. 95
            $table->smallInteger('frecuencia_cardiaca')->nullable(); // ej. 72
            $table->decimal('peso_kg', 5, 2)->nullable();            // ej. 70.5
            $table->decimal('estatura_cm', 5, 2)->nullable();        // ej. 170.0
            $table->text('notas')->nullable();
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salud_registros');
    }
};