<?php

namespace App\Http\Controllers;

use App\Services\PersonaService;
use App\Services\EventohcService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class PersonaController extends Controller
{
    public function __construct(
        protected PersonaService $personaService,
        protected EventohcService $eventohcService,
    ) {
    }

    public function index(Request $request): View|JsonResponse
    {
        $personas = $this->personaService
            ->listar($request->only(['documento', 'apellidos']))
            ->through(fn ($persona) => [
                'id' => $persona->id,
                'name' => trim("{$persona->nombres} {$persona->apellidos} {$persona->apellido_materno}"),
                'dni' => $persona->documento,
                'control' => null, // Definir de que tabla sale el ultimo control
            ]);

        if ($request->wantsJson()) {
            return response()->json($personas);
        }

        return view('patients.index', compact('personas'));
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
}