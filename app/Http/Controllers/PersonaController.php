<?php

namespace App\Http\Controllers;

use App\Services\PersonaService;
use App\Services\EventohcService;
use App\Services\PatientSummaryService;
use App\Services\AntecedenteService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Pagination\LengthAwarePaginator;

class PersonaController extends Controller
{
    public function __construct(
        protected PersonaService $personaService,
        protected EventohcService $eventohcService,
        protected PatientSummaryService $patientSummaryService,
        protected AntecedenteService $antecedenteService,
    ) {
    }

    public function index(Request $request): View|JsonResponse
    {
        $q = $request->input('q', '');

        try {
            $personas = $this->personaService
                ->buscarPorQ($q)
                ->through(fn ($persona) => [
                    'id'     => $persona->id,
                    'name'   => $persona->nombre_completo,
                    'dni'    => $persona->documento,
                    'nro_hc' => $persona->nro_hc ?? '—',
                ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // La tabla persona todavía no existe (entorno sin BD de Alephoo).
            $personas = new LengthAwarePaginator([], 0, 20);
        }

        if ($request->wantsJson()) {
            return response()->json($personas);
        }

        return view('patients.index', compact('personas'));
    }

    public function show(Request $request, int $id): View|JsonResponse
    {
        $persona = $this->personaService->buscar($id);

        if ($request->wantsJson()) {
            return response()->json($persona);
        }

        $historial = $this->eventohcService->historial($id);

        return view('patients.show', compact('persona', 'historial'));
    }

    /**
     * Vista de detalle de paciente (header + tabs + accesos rápidos).
     * Usa datos reales: última consulta con el médico real, patologías,
     * alergias activas y medicación activa.
     */
    public function detail(int $id): View
    {
        $datos = $this->personaService->buscarParaDetalle($id);

        $datos['resumen_clinico'] = $this->patientSummaryService->resumenDe($datos['persona']);
        $datos['antecedentes'] = $this->antecedenteService->antecedentesDe($datos['persona']);

        return view('patients.detail', $datos);
    }
}