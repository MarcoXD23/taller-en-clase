<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Tarea::query()->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'completada' => ['sometimes', 'boolean'],
        ]);
        $datos['completada'] ??= false;

        $tarea = Tarea::create($datos);

        return response()->json(['data' => $tarea], 201);
    }

    public function show(Tarea $tarea)
    {
        return response()->json(['data' => $tarea]);
    }

    public function update(Request $request, Tarea $tarea)
    {
        $datos = $request->validate([
            'titulo' => ['sometimes', 'string', 'max:255'],
            'descripcion' => ['sometimes', 'nullable', 'string'],
            'completada' => ['sometimes', 'boolean'],
        ]);

        $tarea->update($datos);

        return response()->json(['data' => $tarea->fresh()]);
    }

    public function destroy(Tarea $tarea)
    {
        $tarea->delete();

        return response()->noContent();
    }
}
