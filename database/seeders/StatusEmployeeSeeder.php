<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusEmployee;
use App\Models\Employee;
use Faker\Factory as Faker;

class StatusEmployeeSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Remplir la table status_employee avec des données aléatoires
        // Vous pouvez choisir le nombre d'entrées que vous souhaitez insérer
        for ($i = 2; $i <= 50; $i++) {
            // Vérifiez si l'employé existe dans la table employees
            $employee = Employee::find($i);

            if ($employee) {
                StatusEmployee::create([
                    'employee_id' => $employee->employee_id,  // Lier à l'ID de l'employé
                    'status' => $faker->randomElement(['active', 'offline', 'busy']),  // Statut de l'employé
                    'start_time' => $faker->dateTimeThisDecade(),  // Heure de début aléatoire dans cette décennie
                    'end_time' => $faker->dateTimeBetween('now', '+1 year'), // Heure de fin aléatoire dans l'année à venir
                ]);
            }
        }
    }
}
