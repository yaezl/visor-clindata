<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alergia', function (Blueprint $table) {
            $table->id();

            // Relación con el paciente (persona.id)
            $table->Integer('persona_id');

            $table->string('nombre'); // ej: "Penicilina", "Polvo ambiental", "Maní"
            $table->string('tipo')->nullable(); // ej: "Medicamentosa", "Alimentaria", "Ambiental"
            $table->string('severidad')->nullable(); // ej: "Leve", "Moderada", "Severa"
            $table->text('observaciones')->nullable();

            $table->boolean('activa')->default(true);
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
        Schema::dropIfExists('alergia');
    }
};
