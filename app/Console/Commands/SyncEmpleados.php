<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncEmpleados extends Command
{
    protected $signature = 'sync:empleados';
    protected $description = 'Sincroniza los datos de empleados desde la base de datos Fortia (SQL Server)';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Obtener los empleados desde la base de datos SQL Server
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
                    'status' => $empleado->Estatus,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        $this->info('Sincronización de empleados completada.');
    }
}
