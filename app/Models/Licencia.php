<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_licencia_id',
        'nombre',
        'fecha_adquisicion',
        'frecuencia_pago',
        'fecha_siguiente_pago',
        'fecha_recordatorio',
        'estado',
        'usuario_responsable',
        'observaciones'
    ];

    public function tipoLicencia()
    {
        return $this->belongsTo(TipoLicencia::class);
    }


    public function pagos()
    {
        return $this->hasMany(PagoLicencia::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_responsable');
    }

}
