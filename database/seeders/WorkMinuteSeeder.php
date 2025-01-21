<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkMinute;
use App\Models\Employee;
use Faker\Factory as Faker;

class WorkMinuteSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Récupérer tous les employés
        $employees = Employee::all();

        // Insérer des minutes de travail fictives pour chaque employé
        foreach ($employees as $employee) {
            // Pour chaque jour de la semaine, assigner un nombre de minutes de travail aléatoire
            foreach (WorkMinute::DAYS_OF_WEEK as $day) {
                WorkMinute::create([
                    'employee_id' => $employee->employee_id,  // ID de l'employé
                    'minutes_worked' => $faker->numberBetween(180, 480),  // Minutes travaillées entre 3h et 8h
                    'day' => $day,  // Jour de la semaine
                ]);
            }
        }
    }
}
