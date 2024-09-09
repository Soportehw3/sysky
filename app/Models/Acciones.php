<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'modulo',
        'descripcion',
        'usuario_responsable_id',
        'created_at',

    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_responsable_id');
    }
}
