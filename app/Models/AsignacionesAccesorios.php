<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionesAccesorios extends Model
{
    use HasFactory;

    protected $fillable = [
        'empleado_id',
        'accesorio_id',
        'cantidad_asignada',
        'fecha_asignacion',
        'usuario_responsable',
        'ticket',
        'nota_descriptiva'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function accesorio()
    {
        return $this->belongsTo(Accesorio::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_responsable');
    }
}

