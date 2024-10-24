<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Exception;

class EmpleadosSeeder extends Seeder
{
    public function run()
    {
        $oldDbConnection = DB::connection('sqlsrv');

        $empleados = $oldDbConnection->select('
            SELECT 
                RH_TRAB.CLA_TRAB as Nomina, 
                TRIM(RH_TRAB.NOM_TRAB) as Nombre,
                TRIM(RH_TRAB.AP_PATERNO) as ApellidoP,
                TRIM(RH_TRAB.AP_MATERNO) as ApellidoM,
                TRIM(RH_PUESTO.NOM_PUESTO) as Puesto, 
                TRIM(RH_DEPTO.NOM_DEPTO) as Area,
                RH_TRAB.STATUS_TRAB as Estatus
            FROM RH_TRAB
            INNER JOIN RH_PUESTO 
                ON RH_TRAB.CLA_EMPRESA = RH_PUESTO.CLA_EMPRESA 
                AND RH_TRAB.CLA_PUESTO = RH_PUESTO.CLA_PUESTO 
            INNER JOIN RH_DEPTO 
                ON RH_TRAB.CLA_DEPTO = RH_DEPTO.CLA_DEPTO 
                AND RH_TRAB.CLA_EMPRESA = RH_DEPTO.CLA_EMPRESA
            WHERE RH_TRAB.STATUS_TRAB = \'A\' 
            ORDER BY Nomina ASC;
        ');

        try {
            // Iniciar la transacción
            DB::beginTransaction();

            foreach ($empleados as $empleado) {
                $existingEmpleado = DB::table('empleados')->where('numero_nomina', $empleado->Nomina)->first();
                
                if ($existingEmpleado) {
                    // Actualizar si ya existe
                    DB::table('empleados')
                        ->where('numero_nomina', $empleado->Nomina)
                        ->update([
                            'nombre' => $empleado->Nombre,
                            'apellidoP' => $empleado->ApellidoP,
                            'apellidoM' => $empleado->ApellidoM,
                            'puesto' => $empleado->Puesto,
                            'area' => $empleado->Area,
                            'status' => $empleado->Estatus,
                            'updated_at' => now(),
                        ]);
                } else {
                    // Insertar si no existe
                    DB::table('empleados')->insert([
                        'numero_nomina' => $empleado->Nomina,
                        'nombre' => $empleado->Nombre,
                        'apellidoP' => $empleado->ApellidoP,
                        'apellidoM' => $empleado->ApellidoM,
                        'puesto' => $empleado->Puesto,
                        'area' => $empleado->Area,
                        'status' => $empleado->Estatus,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Confirmar la transacción
            DB::commit();
        } catch (Exception $e) {
            // Si algo falla, revertir todos los cambios
            DB::rollBack();
            // Opcional: mostrar o registrar el error
            echo "Error al importar empleados: " . $e->getMessage();
        }
    }
}
