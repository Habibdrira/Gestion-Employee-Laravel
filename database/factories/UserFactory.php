<?php
namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Définit l'état par défaut du modèle.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Assurez-vous que le rôle avec l'ID 2 existe dans la base de données
        $roleId = 2; // Le rôle avec l'ID 2 est attribué par défaut
    
        return [
            'name' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'role_id' => $roleId, // Attribution du role_id par défaut à 2
        ];
    }
    

    /**
     * Indique que l'adresse email du modèle doit être non vérifiée.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
