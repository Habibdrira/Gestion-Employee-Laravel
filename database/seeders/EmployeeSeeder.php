<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\User;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Exécute la commande de semence.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(); // Crée une instance de Faker
        
        // Pour insérer de manière ordonnée de 1 à 20
        for ($i = 5; $i <= 10; $i++) {
            // Vérifiez si l'utilisateur avec ce ID existe
            $user = User::find($i);

            if ($user) {
                Employee::create([
                    'user_id' => $user->id, // Assurez-vous que l'ID utilisateur existe
                    'address' => $faker->address, // Utilisez $faker au lieu de $this->faker
                    'city' => $faker->city,
                    'position' => $faker->jobTitle,
                    'salary' => $faker->numberBetween(30000, 100000),
                ]);
            }
        }
    }
}
