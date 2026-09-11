<?php

namespace Tests\Feature;

use App\Models\Tarea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TareaApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_lista_tareas(): void
    {
        Tarea::factory()->count(2)->create();

        $this->getJson('/api/v1/tareas')
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_crea_una_tarea(): void
    {
        $response = $this->postJson('/api/v1/tareas', [
            'titulo' => 'Preparar el taller',
            'descripcion' => 'Completar el CRUD de la API',
        ]);

        $response->assertCreated()
            ->assertJsonPath('data.titulo', 'Preparar el taller')
            ->assertJsonPath('data.completada', false);

        $this->assertDatabaseHas('tareas', ['titulo' => 'Preparar el taller']);
    }

    public function test_consulta_actualiza_y_elimina_una_tarea(): void
    {
        $tarea = Tarea::factory()->create();

        $this->getJson("/api/v1/tareas/{$tarea->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $tarea->id);

        $this->patchJson("/api/v1/tareas/{$tarea->id}", [
            'completada' => true,
        ])
            ->assertOk()
            ->assertJsonPath('data.completada', true);

        $this->deleteJson("/api/v1/tareas/{$tarea->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('tareas', ['id' => $tarea->id]);
    }

    public function test_rechaza_un_identificador_no_numerico(): void
    {
        $this->getJson('/api/v1/tareas/invalido')
            ->assertNotFound();
    }
}
