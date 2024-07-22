<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadosSeeder extends Seeder
{
    public function run()
    {
        $oldDbConnection = DB::connection('sqlsrv');

        $empleados = $oldDbConnection->select('
            SELECT 
                RH_TRAB.CLA_TRAB as Nomina, 
                RH_TRAB.NOM_TRAB as Nombre,
                RH_TRAB.AP_PATERNO as ApellidoP,
                RH_TRAB.AP_MATERNO as ApellidoM,
                RH_PUESTO.NOM_PUESTO as Puesto, 
                RH_DEPTO.NOM_DEPTO as Area
            FROM RH_TRAB
            INNER JOIN RH_PUESTO 
                ON RH_TRAB.CLA_EMPRESA = RH_PUESTO.CLA_EMPRESA 
                AND RH_TRAB.CLA_PUESTO = RH_PUESTO.CLA_PUESTO 
            INNER JOIN RH_DEPTO 
                ON RH_TRAB.CLA_DEPTO = RH_DEPTO.CLA_DEPTO 
                AND RH_TRAB.CLA_EMPRESA = RH_DEPTO.CLA_EMPRESA
            ORDER BY Nomina ASC;
        ');

        foreach ($empleados as $empleado) {
            // Verificar si el empleado ya existe
            $existingEmpleado = DB::table('empleados')->where('numero_nomina', $empleado->Nomina)->first();
            
            if (!$existingEmpleado) {
                DB::table('empleados')->insert([
                    'numero_nomina' => $empleado->Nomina,
                    'nombre' => $empleado->Nombre,
                    'apellidoP' => $empleado->ApellidoP,
                    'apellidoM' => $empleado->ApellidoM,
                    'puesto' => $empleado->Puesto,
                    'area' => $empleado->Area,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
