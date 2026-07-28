<?php

namespace App\Http\Controllers;

use App\Models\Consultum;
use App\Services\ConsultaService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ConsultaController extends Controller
{
    public function __construct(protected ConsultaService $consultaService)
    {
    }

    /**
     * GET /consultas
     */
    public function index(Request $request): View|JsonResponse
    {
        $consultas = $this->consultaService->listar(
            $request->only(['personal_id', 'evento_id', 'desde', 'hasta'])
        );

        if ($request->wantsJson()) {
            return response()->json($consultas);
        }

        return view('consultas.index', compact('consultas'));
    }

    /**
     * GET /consultas/{consulta}
     */
    public function show(Request $request, int $id): View|JsonResponse
    {
        $consulta = $this->consultaService->buscar($id);

        if ($request->wantsJson()) {
            return response()->json($consulta);
        }

        return view('consultas.show', compact('consulta'));
    }
}