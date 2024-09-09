<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accesorio extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'marca_id',
        'modelo',
        'cantidad',
        'orden_compra_acc',
        'requisicion',
        'cantidad_minima',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function marcaAccesorio()
    {
        return $this->belongsTo(MarcaAccesorio::class, 'marca_id');
    }
}
