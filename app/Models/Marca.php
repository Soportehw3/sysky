<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas';

    protected $fillable = ['nombre'];

    // Relación con equipos
    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'marca_id');
    }
}
