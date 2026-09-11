<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'listado de tareas']);
    }

    public function store(Request $request)
    {
        return response()->json(['message' => 'tarea creada'], 201);
    }

    public function show($id)
    {
        return response()->json(['message' => "mostrando tarea {$id}"]);
    }

    public function update(Request $request, $id)
    {
        return response()->json(['message' => "tarea {$id} actualizada"]);
    }

    public function destroy($id)
    {
        return response()->json(null, 204);
    }
}
