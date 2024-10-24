<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoLicencia extends Model
{
    use HasFactory;

    // Especificar el nombre correcto de la tabla
    protected $table = 'tipos_licencias';

    protected $fillable = ['nombre'];
}
