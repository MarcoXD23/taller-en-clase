<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => Task::all()]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task = Task::create($validated);

        return response()->json(['data' => $task], 201);
    }

    public function show(Task $task): JsonResponse
    {
        return response()->json(['data' => $task]);
    }

    public function update(Request $request, Task $task): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'completed' => 'sometimes|boolean',
        ]);

        $task->update($validated);

        return response()->json(['data' => $task]);
    }

    public function destroy(Task $task): JsonResponse
    {
        $task->delete();

        return response()->json(null, 204);
    }
}
