<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionEquipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'empleado_id',
        'equipo_id',
        'fecha_asignacion',
        'usuario_responsable',
        'ticket',
        'nota_descriptiva',
        'empresa_id'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_responsable'); 
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
