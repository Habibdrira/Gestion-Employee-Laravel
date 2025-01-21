<?php
namespace Database\Factories;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        // Vérifie si un employé avec ce user_id existe déjà
        $user = User::inRandomOrder()->first(); // Récupère un utilisateur aléatoire
        
        // S'assurer qu'il n'y a pas déjà un employé avec ce user_id
        if (Employee::where('user_id', $user->id)->exists()) {
            return []; // Ne rien insérer si un doublon existe
        }

        return [
            'user_id' => $user->id,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'position' => $this->faker->jobTitle,
            'salary' => $this->faker->numberBetween(30000, 100000),
        ];
    }
}
