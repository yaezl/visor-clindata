<?php

namespace App\Http\Controllers;

use App\Services\HcVacunaService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class HcVacunaController extends Controller
{
    public function __construct(protected HcVacunaService $hcVacunaService)
    {
    }

    /**
     * GET /vacunas
     */
    public function index(Request $request): View|JsonResponse
    {
        $vacunas = $this->hcVacunaService->listar($request->only(['nombre']));

        if ($request->wantsJson()) {
            return response()->json($vacunas);
        }

        return view('vacunas.index', compact('vacunas'));
    }

    /**
     * GET /vacunas/{id}
     */
    public function show(Request $request, int $id): View|JsonResponse
    {
        $vacuna = $this->hcVacunaService->buscar($id);

        if ($request->wantsJson()) {
            return response()->json($vacuna);
        }

        return view('vacunas.show', compact('vacuna'));
    }
}