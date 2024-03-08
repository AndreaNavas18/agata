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
        // EmployeeState::create(['name' => 'Activo']);
        // EmployeeState::create(['name' => 'Inactivo']);
        // EmployeeState::create(['name' => 'Retirado']);
        // EmployeeState::create(['name' => 'Vacaciones']);
        // EmployeeState::create(['name' => 'Eliminado']);

        // ARL
        // EmployeeArl::create(['name' => 'Bolivar']);

        // Fondos de Pensiones
        // EmployeePensionFund::create(['name' => 'Protección']);
        // EmployeePensionFund::create(['name' => 'Porvenir']);
        // EmployeePensionFund::create(['name' => 'ING fondo de pensiones obligatoria']);
        // EmployeePensionFund::create(['name' => 'Colfondos S.A.']);
        // EmployeePensionFund::create(['name' => 'Skandia Obligatorio']);
        // EmployeePensionFund::create(['name' => 'Pensión jubilados']);
        // EmployeePensionFund::create(['name' => 'Pensión aprendiz sena']);
        // EmployeePensionFund::create(['name' => 'Colpensiones']);
        // EmployeePensionFund::create(['name' => 'Horizonte']);

        // Fondos de Cesantías
        // EmployeeSeveranceFund::create(['name' => 'Colfondos']);
        // EmployeeSeveranceFund::create(['name' => 'Porvenir']);
        // EmployeeSeveranceFund::create(['name' => 'Horizonte']);
        // EmployeeSeveranceFund::create(['name' => 'Fondo Nacional del Ahorro']);
        // EmployeeSeveranceFund::create(['name' => 'Cesantías aprendiz']);
        // EmployeeSeveranceFund::create(['name' => 'Protección']);

        // EPS
        // EmployeeEps::create(['name' => 'Nueva EPS']);
        // EmployeeEps::create(['name' => 'Colmedica EPS']);
        // EmployeeEps::create(['name' => 'Salud Total']);
        // EmployeeEps::create(['name' => 'Medimas']);
        // EmployeeEps::create(['name' => 'Sanitas']);
        // EmployeeEps::create(['name' => 'EPS Sura']);
        // EmployeeEps::create(['name' => 'Comfenalco Valle']);
        // EmployeeEps::create(['name' => 'Saludcoop']);
        // EmployeeEps::create(['name' => 'Coomeva']);
        // EmployeeEps::create(['name' => 'S.O.S.']);
        // EmployeeEps::create(['name' => 'Cruz Blanca']);
        // EmployeeEps::create(['name' => 'Compensar']);
        // EmployeeEps::create(['name' => 'Programa Servicios Médicos Colpatria']);
        // EmployeeEps::create(['name' => 'Emssanar']);
        // EmployeeEps::create(['name' => 'Coosalud']);
        // EmployeeEps::create(['name' => 'Asmet Salud']);
        // EmployeeEps::create(['name' => 'Mutual Ser']);
        // EmployeeEps::create(['name' => 'Cafesalud']);
        // EmployeeEps::create(['name' => 'Mallamas']);
        // EmployeeEps::create(['name' => 'AIC Asociación Indígena del Cauca']);

        // //departamentos
        // EmployeePositionDepartment::create(['name' => 'Soporte']);
        // EmployeePositionDepartment::create(['name' => 'Gerencia']);
        // EmployeePositionDepartment::create(['name' => 'Comercial']);

        // //cargos
        // EmployeePosition::create([
        //     'name' => 'Técnico',
        //     'department_id' => 1,
        // ]);

        // EmployeePosition::create([
        //     'name' => 'Soporte oficina',
        //     'department_id' => 1,
        // ]);


        // Employee::create([
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
