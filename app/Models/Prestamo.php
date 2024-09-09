<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\PrestamoEntregaNotification;
use Illuminate\Support\Facades\Notification;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipo_id',
        'empleado_id',
        'fecha_prestamo',
        'fecha_regreso',
        'usuario_responsable_id',
        'devuelto',
        'nota_prestamo',


    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_responsable_id');
    }

    public static function enviarNotificaciones()
    {
        $prestamos = self::whereDate('fecha_regreso', now()->toDateString())->get();

        foreach ($prestamos as $prestamo) {
            Notification::send($prestamo->usuario, new PrestamoEntregaNotification($prestamo));
        }
    }
}
