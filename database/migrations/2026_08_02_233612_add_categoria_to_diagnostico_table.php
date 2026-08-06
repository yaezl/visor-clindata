<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Agrega 'categoria' a diagnostico para poder agrupar los diagnósticos
 * en el Resumen del paciente (ej: detectar patrones de consultas
 * respiratorias recurrentes) sin depender de heurísticas sobre el
 * código CIE10 ni de mapeos hardcodeados en el service.
 *
 * Valores esperados (libres, coherentes con el seeder pediátrico):
 * 'respiratorio', 'digestivo', 'otorrinolaringologico', 'urinario',
 * 'control', 'otros'.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('diagnostico', function (Blueprint $table) {
            $table->string('categoria')->nullable()->after('nombre');
        });
    }

    public function down(): void
    {
        Schema::table('diagnostico', function (Blueprint $table) {
            $table->dropColumn('categoria');
        });
    }
};