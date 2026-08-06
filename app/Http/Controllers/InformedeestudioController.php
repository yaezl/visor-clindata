<?php

namespace App\Http\Controllers;

use App\Services\InformedeestudioService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class InformedeestudioController extends Controller
{
    public function __construct(protected InformedeestudioService $informedeestudioService)
    {
    }

    /**
     * GET /informes-de-estudio
     */
    public function index(Request $request): View|JsonResponse
    {
        $informes = $this->informedeestudioService->listar(
            $request->only(['estudio_id', 'ordendeestudio_id', 'informadopor_id', 'evento_id', 'desde', 'hasta'])
        );

        if ($request->wantsJson()) {
            return response()->json($informes);
        }

        return view('informes-de-estudio.index', compact('informes'));
    }

    /**
     * GET /informes-de-estudio/{informedeestudio}
     */
    public function show(Request $request, int $id): View|JsonResponse
    {
        $informe = $this->informedeestudioService->buscar($id);

        if ($request->wantsJson()) {
            return response()->json($informe);
        }

        return view('informes-de-estudio.show', compact('informe'));
    }

    /**
     * GET /informes-de-estudio/pendientes
     */
    public function pendientes(Request $request): View|JsonResponse
    {
        $informes = $this->informedeestudioService->pendientes(
            $request->only(['estudio_id', 'ordendeestudio_id', 'informadopor_id', 'evento_id', 'desde', 'hasta'])
        );

        if ($request->wantsJson()) {
            return response()->json($informes);
        }

        return view('informes-de-estudio.pendientes', compact('informes'));
    }

    /**
     * GET /informes-de-estudio/urgentes
     */
    public function urgentes(Request $request): View|JsonResponse
    {
        $informes = $this->informedeestudioService->urgentes(
            $request->only(['estudio_id', 'ordendeestudio_id', 'informadopor_id', 'evento_id', 'desde', 'hasta'])
        );

        if ($request->wantsJson()) {
            return response()->json($informes);
        }

        return view('informes-de-estudio.urgentes', compact('informes'));
    }
}