<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        \App\Models\User::factory(10)->create(); // Créer 1000 utilisateurs
    

    $this->call([
        EmployeeSeeder::class,
        AbsenceSeeder::class, // Ajoutez ceci pour appeler le seeder AbsenceSeeder
        PerformanceSeeder::class,
        PrimeSeeder::class,
    ]);


    }
    
}
