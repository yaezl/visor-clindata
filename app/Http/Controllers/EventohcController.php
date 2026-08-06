<?php

namespace App\Http\Controllers;

use App\Services\EventohcService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class EventohcController extends Controller
{
    public function __construct(protected EventohcService $eventohcService)
    {
    }

    /**
     * GET /eventos
     */
    public function index(Request $request): View|JsonResponse
    {
        $eventos = $this->eventohcService->listar(
            $request->only(['persona_id', 'desde', 'hasta'])
        );

        if ($request->wantsJson()) {
            return response()->json($eventos);
        }

        return view('eventos.index', compact('eventos'));
    }

    /**
     * GET /eventos/{id}
     */
    public function show(Request $request, int $id): View|JsonResponse
    {
        $evento = $this->eventohcService->buscar($id);

        if ($request->wantsJson()) {
            return response()->json($evento);
        }

        return view('eventos.show', compact('evento'));
    }
}