<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoLicencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'licencia_id',
        'monto',
        'fecha_pago',
        'detalle'
    ];

    public function licencia()
    {
        return $this->belongsTo(Licencia::class);
    }
}


