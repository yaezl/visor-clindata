<?php

namespace App\Http\Controllers;

use App\Services\PersonaService;
use App\Services\EventohcService;
use App\Services\PatientSummaryService;
use App\Services\AntecedenteService;
use App\Services\VacunacionService;
use App\Services\CrecimientoService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Barryvdh\DomPDF\Facade\Pdf;

class PersonaController extends Controller
{
    public function __construct(
        protected PersonaService $personaService,
        protected EventohcService $eventohcService,
        protected PatientSummaryService $patientSummaryService,
        protected AntecedenteService $antecedenteService,
        protected VacunacionService $vacunacionService, 
        protected CrecimientoService $crecimientoService,
    ) {
    }

    public function index(Request $request): View|JsonResponse
    {
        $q       = (string) $request->input('q', '');
        $filtros   = $request->only(['sexo', 'edad_desde', 'edad_hasta', 'obra_social']);

        try {
            $personas = $this->personaService
                ->buscarPorQ($q, filtros: $filtros)
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
        $datos['vacunacion']      = $this->vacunacionService->calcularParaPaciente($datos['persona']);
        $datos['crecimiento'] = $this->crecimientoService->calcularParaPaciente($datos['persona']);

        return view('patients.detail', $datos);
    }

 /**
     * Exportar historial médico a PDF
     * Solo muestra iniciales del nombre y apellido, sexo, fecha de nacimiento y edad
     */
    public function exportHistorialPDF(int $id)
    {
        $persona = $this->personaService->buscar($id);
        $historial = $this->eventohcService->historial($id);
 
        // Calcular iniciales
        $inicialNombre = strtoupper(substr($persona->nombres, 0, 1));
        $inicialApellido = strtoupper(substr($persona->apellidos, 0, 1));
 
        $data = [
            'persona' => $persona,
            'historial' => $historial,
            'inicialNombre' => $inicialNombre,
            'inicialApellido' => $inicialApellido,
            'fecha_impresion' => now()->format('d/m/Y H:i'),
        ];
 
        $pdf = Pdf::loadView('patients.partials.historial-pdf', $data);
        
        $nombreArchivo = "Historial_".$inicialNombre.$inicialApellido."_".now()->format('d-m-Y').".pdf";
        
        return $pdf->download($nombreArchivo);
    }
}
 