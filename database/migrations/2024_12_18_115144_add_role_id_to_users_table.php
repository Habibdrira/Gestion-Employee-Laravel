<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Ajouter la colonne 'role_id' à la table 'users' avec une valeur par défaut 2 (Employee)
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->default(2)->after('password');
            $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('cascade');
        });

        // Insérer des utilisateurs par défaut avec les rôles 1 (Admin) et 2 (Employee)
        DB::table('users')->insert([
            [   'id' => '1',
                'name' => 'Admin',
                'lastname' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'), // Hachage du mot de passe
                'role_id' => 1, // Rôle Admin
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [    
                'id' => '2',
                'name' => 'Employee',
                'lastname' => 'Employee',
                'email' => 'employee@example.com',
                'password' => Hash::make('employee123'), // Hachage du mot de passe
                'role_id' => 2, // Rôle Employee
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Supprimer les utilisateurs insérés par défaut
        DB::table('users')->whereIn('email', ['admin@example.com', 'employee@example.com'])->delete();

        // Supprimer la colonne et la clé étrangère 'role_id' de la table 'users'
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
