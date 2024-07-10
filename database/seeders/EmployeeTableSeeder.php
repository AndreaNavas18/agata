<?php

namespace Database\Seeders;

use App\Models\Employees\Employee;
use App\Models\Employees\EmployeeArl;
use App\Models\Employees\EmployeeEps;
use App\Models\Employees\EmployeePensionFund;
use App\Models\Employees\EmployeePosition;
use App\Models\Employees\EmployeePositionDepartment;
use App\Models\Employees\EmployeeSeveranceFund;
use App\Models\Employees\EmployeeState;
use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Estados
        EmployeeState::firstOrCreate(['name' => 'Activo']);
        EmployeeState::firstOrCreate(['name' => 'Inactivo']);
        EmployeeState::firstOrCreate(['name' => 'Retirado']);
        EmployeeState::firstOrCreate(['name' => 'Vacaciones']);
        EmployeeState::firstOrCreate(['name' => 'Eliminado']);

        // ARL
        EmployeeArl::firstOrCreate(['name' => 'Bolivar']);

        // Fondos de Pensiones
        EmployeePensionFund::firstOrCreate(['name' => 'Protección']);
        EmployeePensionFund::firstOrCreate(['name' => 'Porvenir']);
        EmployeePensionFund::firstOrCreate(['name' => 'ING fondo de pensiones obligatoria']);
        EmployeePensionFund::firstOrCreate(['name' => 'Colfondos S.A.']);
        EmployeePensionFund::firstOrCreate(['name' => 'Skandia Obligatorio']);
        EmployeePensionFund::firstOrCreate(['name' => 'Pensión jubilados']);
        EmployeePensionFund::firstOrCreate(['name' => 'Pensión aprendiz sena']);
        EmployeePensionFund::firstOrCreate(['name' => 'Colpensiones']);
        EmployeePensionFund::firstOrCreate(['name' => 'Horizonte']);

        // Fondos de Cesantías
        EmployeeSeveranceFund::firstOrCreate(['name' => 'Colfondos']);
        EmployeeSeveranceFund::firstOrCreate(['name' => 'Porvenir']);
        EmployeeSeveranceFund::firstOrCreate(['name' => 'Horizonte']);
        EmployeeSeveranceFund::firstOrCreate(['name' => 'Fondo Nacional del Ahorro']);
        EmployeeSeveranceFund::firstOrCreate(['name' => 'Cesantías aprendiz']);
        EmployeeSeveranceFund::firstOrCreate(['name' => 'Protección']);

        // EPS
        EmployeeEps::firstOrCreate(['name' => 'Nueva EPS']);
        EmployeeEps::firstOrCreate(['name' => 'Colmedica EPS']);
        EmployeeEps::firstOrCreate(['name' => 'Salud Total']);
        EmployeeEps::firstOrCreate(['name' => 'Medimas']);
        EmployeeEps::firstOrCreate(['name' => 'Sanitas']);
        EmployeeEps::firstOrCreate(['name' => 'EPS Sura']);
        EmployeeEps::firstOrCreate(['name' => 'Comfenalco Valle']);
        EmployeeEps::firstOrCreate(['name' => 'Saludcoop']);
        EmployeeEps::firstOrCreate(['name' => 'Coomeva']);
        EmployeeEps::firstOrCreate(['name' => 'S.O.S.']);
        EmployeeEps::firstOrCreate(['name' => 'Cruz Blanca']);
        EmployeeEps::firstOrCreate(['name' => 'Compensar']);
        EmployeeEps::firstOrCreate(['name' => 'Programa Servicios Médicos Colpatria']);
        EmployeeEps::firstOrCreate(['name' => 'Emssanar']);
        EmployeeEps::firstOrCreate(['name' => 'Coosalud']);
        EmployeeEps::firstOrCreate(['name' => 'Asmet Salud']);
        EmployeeEps::firstOrCreate(['name' => 'Mutual Ser']);
        EmployeeEps::firstOrCreate(['name' => 'Cafesalud']);
        EmployeeEps::firstOrCreate(['name' => 'Mallamas']);
        EmployeeEps::firstOrCreate(['name' => 'AIC Asociación Indígena del Cauca']);

        // //departamentos
        EmployeePositionDepartment::firstOrCreate(['name' => 'Soporte']);
        EmployeePositionDepartment::firstOrCreate(['name' => 'Gerencia']);
        EmployeePositionDepartment::firstOrCreate(['name' => 'Comercial']);

        // //cargos
        EmployeePosition::firstOrCreate([
            'name' => 'Técnico',
            'department_id' => 1,
        ]);

        EmployeePosition::firstOrCreate([
            'name' => 'Soporte oficina',
            'department_id' => 1,
        ]);


        // Employee::firstOrCreate([
        // 	'id'                      => 1,
        //     'type_document_id'      => 1,
        // 	'identification'          => 1143854194,
	    //     'first_name'            => 'Julian',
	    //     'surname'               => 'Calderon',
	    //     'full_name'             => 'Julian Calderon',
	    //     'birth_date'            => '1994-02-24',
	    //     'email'                  => 'jcalderon@stratecsa.com',
	    //     'address'               => 'Cra 7j',
	    //     'state_id'              => 1,
	    //     'arl_id'                => 1,
	    //     'fund_pension_id'       => 1,
	    //     'severance_fund_id'     => 1,
	    //     'eps_id'                => 1,
	    //     'position_id'           => 1,
        // ]);
    }

}
