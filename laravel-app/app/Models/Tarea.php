<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'completada',
    ];

    protected function casts(): array
    {
        return [
            'completada' => 'boolean',
        ];
    }
}
