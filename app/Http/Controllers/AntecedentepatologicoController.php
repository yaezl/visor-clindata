<?php

namespace App\Http\Controllers;

use App\Services\AntecedentepatologicoService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class AntecedentepatologicoController extends Controller
{
    public function __construct(protected AntecedentepatologicoService $antecedentepatologicoService)
    {
    }

    /**
     * GET /antecedentes-patologicos
     */
    public function index(Request $request): View|JsonResponse
    {
        $antecedentes = $this->antecedentepatologicoService->listar(
            $request->only(['persona_id'])
        );

        if ($request->wantsJson()) {
            return response()->json($antecedentes);
        }

        return view('antecedentes-patologicos.index', compact('antecedentes'));
    }

    /**
     * GET /antecedentes-patologicos/{id}
     */
    public function show(Request $request, int $id): View|JsonResponse
    {
        $antecedente = $this->antecedentepatologicoService->buscar($id);

        if ($request->wantsJson()) {
            return response()->json($antecedente);
        }

        return view('antecedentes-patologicos.show', compact('antecedente'));
    }
}