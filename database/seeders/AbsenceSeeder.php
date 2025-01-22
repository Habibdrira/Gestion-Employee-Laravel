<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Absence;
use App\Models\Employee;
use Faker\Factory as Faker;
use Carbon\Carbon; // Importation de Carbon pour manipuler les dates

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

        // Récupérer la date d'aujourd'hui et ajuster pour obtenir la date de la semaine en cours
        $currentDate = Carbon::now();

        // Pour insérer des absences pour les employés existants
        for ($i = 2; $i <= 10; $i++) { // L'ID de l'employé est de 2 à 50
            $employee = Employee::find($i); // Trouver un employé par ID

            if ($employee) {
                // Récupérer un jour de cette semaine pour l'absence (par exemple, un jour aléatoire)
                $absenceDate = $currentDate->copy()->startOfWeek()->addDays(rand(0, 6)); // Un jour aléatoire de la semaine

                Absence::create([
                    'employee_id' => $employee->employee_id, // L'ID de l'employé
                    'date' => $absenceDate->toDateString(), // Date de l'absence (au format Y-m-d)
                    'reason' => $faker->sentence(3), // Raison de l'absence
                    'duration' => $faker->numberBetween(1, 5), // Durée de l'absence en jours
                ]);
            }
        }
    }
}
