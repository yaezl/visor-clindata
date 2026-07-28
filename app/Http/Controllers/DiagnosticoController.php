<?php

namespace App\Http\Controllers;

use App\Services\DiagnosticoService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DiagnosticoController extends Controller
{
    public function __construct(protected DiagnosticoService $diagnosticoService)
    {
    }

    /**
     * GET /diagnosticos
     */
    public function index(Request $request): View|JsonResponse
    {
        $diagnosticos = $this->diagnosticoService->listar(
            $request->only(['nombre', 'codigocie10'])
        );

        if ($request->wantsJson()) {
            return response()->json($diagnosticos);
        }

        return view('diagnosticos.index', compact('diagnosticos'));
    }

    /**
     * GET /diagnosticos/{id}
     */
    public function show(Request $request, int $id): View|JsonResponse
    {
        $diagnostico = $this->diagnosticoService->buscar($id);

        if ($request->wantsJson()) {
            return response()->json($diagnostico);
        }

        return view('diagnosticos.show', compact('diagnostico'));
    }
}