<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_serie',
        'marca_id',
        'modelo',
        'etiqueta_skytex',
        'tipo_equipo_id',
        'orden_compra',
        'requisicion',
        'estado',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function tipoEquipo()
    {
        return $this->belongsTo(TipoEquipo::class, 'tipo_equipo_id');
    }

    public function asignaciones()
    {
        return $this->hasMany(AsignacionEquipo::class);
    }

    public function asignacionActual()
    {
        return $this->hasOne(AsignacionEquipo::class)->latest();
    }

    public function empleadoActual()
    {
        return $this->asignacionActual()->with('empleado')->first()->empleado ?? null;
    }
}