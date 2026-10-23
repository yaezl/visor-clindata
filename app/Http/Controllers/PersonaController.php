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
        $q      = (string) $request->input('q', '');
        $filtros = $request->only([
            'sexo',
            'edad_desde',
            'edad_hasta',
            'obra_social',
            'grupo_sanguineo',
            'es_cronico',
        ]);

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
            $personas = new LengthAwarePaginator([], 0, 20);
        }

        if ($request->wantsJson()) {
            return response()->json($personas);
        }

        $gruposSanguineos = $this->personaService->gruposSanguineos();
        $obrasSociales    = $this->personaService->obrasSocialesConPacientes();

        return view('patients.index', compact('personas', 'gruposSanguineos', 'obrasSociales'));
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
     * Vista de detalle — solo carga los datos del header.
     * Los 4 paneles se cargan lazy vía fetch cuando el usuario los abre.
     */
    public function detail(int $id): View
    {
        $datos = $this->personaService->buscarParaDetalle($id);

        return view('patients.detail', $datos);
    }

    // ── Paneles lazy ──────────────────────────────────────────────────────

    public function panelResumen(int $id): View
    {
        $persona         = $this->personaService->buscarConEventos($id);
        $resumen_clinico = $this->patientSummaryService->resumenDe($persona);
        $alergias        = $persona->alergias;

        // Texto resumen que el partial muestra en el bloque introductorio.
        // Se armaba antes en el @php de detail.blade.php.
        $edad              = $this->personaService->edadFormateada($persona->fecha_nacimiento);
        $nombresAlergias   = $alergias->pluck('nombre');
        $fraseAlergias     = $nombresAlergias->isNotEmpty()
            ? "Alérgico a {$nombresAlergias->implode(', ')}. "
            : '';
        $cantidadConsultas = $resumen_clinico['cantidad_consultas'];
        $fraseConsultas    = $cantidadConsultas > 0
            ? "{$cantidadConsultas} " . ($cantidadConsultas === 1 ? 'consulta registrada' : 'consultas registradas') . '. '
            : 'Sin consultas registradas. ';
        $tieneMedicacion   = $resumen_clinico['medicacion_activa']->isNotEmpty();

        $resumen = ($edad ? "Paciente de {$edad}. " : 'Paciente. ')
            . $fraseConsultas
            . $fraseAlergias
            . ($tieneMedicacion ? 'Con medicación activa.' : 'Sin medicación activa.');

        return view('patients.partials.summary-expandable', compact(
            'persona', 'resumen_clinico', 'alergias', 'resumen'
        ));
    }

    public function panelAntecedentes(int $id): View
    {
        $persona      = $this->personaService->buscarConAntecedentes($id);
        $antecedentes = $this->antecedenteService->antecedentesDe($persona);

        return view('patients.partials.antecedentes-expandable', compact(
            'persona', 'antecedentes'
        ));
    }

    public function panelVacunacion(int $id): View
    {
        $persona    = $this->personaService->buscarBasico($id);
        $vacunacion = $this->vacunacionService->calcularParaPaciente($persona);

        return view('patients.partials.vacunacion-expandable', compact(
            'persona', 'vacunacion'
        ));
    }

    public function panelCrecimiento(int $id): View
    {
        $persona = $this->personaService->buscarConMediciones($id);
        $crecimiento = $this->crecimientoService->calcularParaPaciente($persona);

        return view('patients.partials.crecimiento-expandable', compact(
            'persona', 'crecimiento'
        ));
    }

    /**
     * Exportar historial médico a PDF.
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
 
        $pdf = Pdf::loadView('patients.partials.pdf-history', $data);
        
        $nombreArchivo = "Historial_".$inicialNombre.$inicialApellido."_".now()->format('d-m-Y').".pdf";
        
        return $pdf->download($nombreArchivo);
    }
}
 