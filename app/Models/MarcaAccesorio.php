<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarcaAccesorio extends Model
{
    protected $table = 'marcas_accesorios';

    protected $fillable = ['nombre'];

    // Relación con accesorios
    public function accesorios()
    {
        return $this->hasMany(Accesorio::class, 'marca_id');
    }
}
