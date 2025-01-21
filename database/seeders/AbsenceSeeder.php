<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Absence;
use App\Models\Employee;
use Faker\Factory as Faker;

class AbsenceSeeder extends Seeder
{
    /**
     * Exécute la commande de semence.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(); // Crée une instance de Faker

        // Pour insérer des absences pour les employés existants
        for ($i = 5; $i <= 10; $i++) { // L'ID de l'employé est de 2 à 20
            $employee = Employee::find($i); // Trouver un employé par ID

            if ($employee) {
                Absence::create([
                    'employee_id' => $employee->employee_id, // L'ID de l'employé
                    'date' => $faker->date(), // Date de l'absence
                    'reason' => $faker->sentence(3), // Raison de l'absence
                    'duration' => $faker->numberBetween(1, 5), // Durée de l'absence en jours
                ]);
            }
        }
    }
}
