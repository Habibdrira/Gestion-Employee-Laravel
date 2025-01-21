<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Performance;
use App\Models\Employee;
use Faker\Factory as Faker;

class PerformanceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Remplir la table performance avec des données aléatoires
        // Vous pouvez choisir le nombre d'entrées que vous souhaitez insérer
        for ($i = 2; $i <= 9; $i++) {
            // Vérifiez si l'employé existe dans la table employees
            $employee = Employee::find($i);
            
            if ($employee) {
                Performance::create([
                    'employee_id' => $employee->employee_id,  // Lier à l'ID de l'employé
                    'date' => $faker->date(),  // Date aléatoire
                    'rating' => $faker->numberBetween(1, 5),  // Note aléatoire de 1 à 5
                ]);
            }
        }
    }
}
