<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DemandeConge;
use App\Models\Employee;
use Faker\Factory as Faker;

class DemandeCongeSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Remplir la table demande_conges avec des données aléatoires
        // Vous pouvez choisir le nombre d'entrées que vous souhaitez insérer
        for ($i = 2; $i <= 50; $i++) {
            // Vérifiez si l'employé existe dans la table employees
            $employee = Employee::find($i);

            if ($employee) {
                DemandeConge::create([
                    'employee_id' => $employee->employee_id,  // Lier à l'ID de l'employé
                    'date_debut' => $faker->date(),  // Date de début aléatoire
                    'date_fin' => $faker->date(),    // Date de fin aléatoire
                    'type' => $faker->randomElement(['Maladie', 'Vacances', 'Urgence']),  // Type de congé
                    'commentaire' => $faker->sentence(),  // Commentaire aléatoire
                    'statut' => $faker->randomElement(['En attente', 'Approuvé', 'Rejeté']), // Statut du congé
                ]);
            }
        }
    }
}
