<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_lista_las_tareas_existentes(): void
    {
        Task::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/tasks');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_crea_una_tarea_nueva(): void
    {
        $payload = ['title' => 'Repasar rutas de Laravel'];

        $response = $this->postJson('/api/v1/tasks', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment(['title' => 'Repasar rutas de Laravel']);

        $this->assertDatabaseHas('tasks', ['title' => 'Repasar rutas de Laravel']);
    }

    public function test_devuelve_404_si_la_tarea_no_existe(): void
    {
        $response = $this->getJson('/api/v1/tasks/999');

        $response->assertStatus(404);
    }
}
