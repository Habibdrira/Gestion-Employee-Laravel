<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Performance;
use App\Models\Employee;
use Faker\Factory as Faker;
use Carbon\Carbon;

class PerformanceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Récupérer les dates de début et de fin de la semaine en cours
        $startOfWeek = Carbon::now()->startOfWeek(); // Premier jour de cette semaine
        $endOfWeek = Carbon::now()->endOfWeek(); // Dernier jour de cette semaine

        // Remplir la table performance avec des données pour cette semaine
        // Vous pouvez choisir le nombre d'entrées que vous souhaitez insérer
        for ($i = 2; $i <= 50; $i++) {
            // Vérifiez si l'employé existe dans la table employees
            $employee = Employee::find($i);

            if ($employee) {
                // Générer une date aléatoire entre le début et la fin de cette semaine
                $randomDate = $faker->dateTimeBetween($startOfWeek, $endOfWeek);

                Performance::create([
                    'employee_id' => $employee->employee_id,  // Lier à l'ID de l'employé
                    'date' => $randomDate,  // Date aléatoire dans cette semaine
                    'rating' => $faker->numberBetween(1, 5),  // Note aléatoire de 1 à 5
                ]);
            }
        }
    }
}
