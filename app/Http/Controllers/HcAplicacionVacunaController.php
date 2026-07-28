<?php

namespace App\Http\Controllers;

use App\Services\HcAplicacionVacunaService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class Hc_Aplicacion_VacunaController extends Controller
{
    public function __construct(protected HcAplicacionVacunaService $hcAplicacionVacunaService)
    {
    }

    /**
     * GET /aplicaciones-vacuna
     */
    public function index(Request $request): View|JsonResponse
    {
        $aplicaciones = $this->hcAplicacionVacunaService->listar($request->only(['vacuna_id']));

        if ($request->wantsJson()) {
            return response()->json($aplicaciones);
        }

        return view('aplicaciones-vacuna.index', compact('aplicaciones'));
    }

    /**
     * GET /aplicaciones-vacuna/{id}
     */
    public function show(Request $request, int $id): View|JsonResponse
    {
        $aplicacion = $this->hcAplicacionVacunaService->buscar($id);

        if ($request->wantsJson()) {
            return response()->json($aplicacion);
        }

        return view('aplicaciones-vacuna.show', compact('aplicacion'));
    }
}