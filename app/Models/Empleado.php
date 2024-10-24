<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_nomina',
        'nombre',
        'apellidoP',
        'apellidoM',
        'puesto',
        'area',
        'status'
    ];

    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }

    public function accesorios()
    {
        return $this->hasMany(Accesorio::class);
    }

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }

    public function asignacionesequipos()
    {
        return $this->hasMany(AsignacionEquipo::class);
    }

    public function asignacionesaccesorios()
    {
        return $this->hasMany(AsignacionesAccesorios::class);
    }

    public function salidas()
    {
        return $this->hasMany(SalidaEquipo::class);
    }

}

   

