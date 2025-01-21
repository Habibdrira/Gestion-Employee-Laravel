<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prime;
use App\Models\Employee;
use Faker\Factory as Faker;

class PrimeSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Remplir la table prime avec des données aléatoires
        for ($i = 2; $i <= 50; $i++) {
            // Vérifiez si l'employé existe dans la table employees
            $employee = Employee::find($i);
            
            if ($employee) {
                Prime::create([
                    'employee_id' => $employee->employee_id,  // Lier à l'ID de l'employé
                    'amount' => $faker->numberBetween(1000, 5000),  // Montant aléatoire entre 1000 et 5000
                    'date_awarded' => $faker->date(),  // Date aléatoire pour la prime
                    'absence_factor' => $faker->numberBetween(0, 1),  // Facteur d'absence, 0 ou 1
                    'performance_factor' => $faker->numberBetween(1, 5),  // Facteur de performance entre 1 et 5
                ]);
            }
        }
    }
}
