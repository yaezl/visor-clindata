<?php

namespace App\Http\Controllers;

use App\Services\OrdendeestudioService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class OrdendeestudioController extends Controller
{
    public function __construct(protected OrdendeestudioService $ordendeestudioService)
    {
    }

    /**
     * GET /ordenes-de-estudio
     */
    public function index(Request $request): View|JsonResponse
    {
        $ordenes = $this->ordendeestudioService->listar(
            $request->only(['diagnostico_id', 'estudio_id'])
        );

        if ($request->wantsJson()) {
            return response()->json($ordenes);
        }

        return view('ordenes-de-estudio.index', compact('ordenes'));
    }

    /**
     * GET /ordenes-de-estudio/{ordendeestudio}
     */
    public function show(Request $request, int $id): View|JsonResponse
    {
        $orden = $this->ordendeestudioService->buscar($id);

        if ($request->wantsJson()) {
            return response()->json($orden);
        }

        return view('ordenes-de-estudio.show', compact('orden'));
    }
}