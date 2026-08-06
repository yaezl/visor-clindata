<?php

namespace App\Http\Controllers;

use App\Services\InternacionPersonaService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class InternacionPersonaController extends Controller
{
    public function __construct(protected InternacionPersonaService $internacionPersonaService)
    {
    }

    /**
     * GET /internaciones
     */
    public function index(Request $request): View|JsonResponse
    {
        $internaciones = $this->internacionPersonaService->listar(
            $request->only(['persona_id', 'evento_id', 'plan_id', 'desde', 'hasta', 'incluir_borrados'])
        );

        if ($request->wantsJson()) {
            return response()->json($internaciones);
        }

        return view('internaciones.index', compact('internaciones'));
    }

    /**
     * GET /internaciones/{internacionPersona}
     *
     * Trae también la epicrisis y la hoja de evolución (con sus descripciones)
     * de la internación, ya que no tienen controller propio.
     */
    public function show(Request $request, int $id): View|JsonResponse
    {
        $internacion = $this->internacionPersonaService->buscar($id);

        if ($request->wantsJson()) {
            return response()->json($internacion);
        }

        return view('internaciones.show', compact('internacion'));
    }
}