<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicacion', function (Blueprint $table) {
            $table->id();

            // Relación con el paciente (persona.id) - int SIGNED, igual que persona.id
            $table->integer('persona_id');

            $table->string('nombre'); // ej: "Salbutamol", "Loratadina"
            $table->string('dosis')->nullable(); // ej: "100mcg", "10mg"
            $table->string('frecuencia')->nullable(); // ej: "Cada 8 horas", "1 vez al día"
            $table->string('via_administracion')->nullable(); // ej: "Oral", "Inhalatoria"
            $table->text('observaciones')->nullable();

            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();

            $table->boolean('activa')->default(true); // true = medicación activa/vigente
            $table->boolean('borrado_logico')->default(false);

            $table->unsignedBigInteger('creado_por_id')->nullable();
            $table->unsignedBigInteger('modificado_por_id')->nullable();

            $table->timestamp('creado_en')->useCurrent();
            $table->timestamp('modificado_en')->nullable();
            $table->timestamp('borrado_en')->nullable();

            $table->foreign('persona_id')
                ->references('id')->on('persona')
                ->onDelete('cascade');

            $table->index('persona_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicacion');
    }
};