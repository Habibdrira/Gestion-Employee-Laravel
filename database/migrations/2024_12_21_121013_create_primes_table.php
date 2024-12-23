<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimesTable extends Migration
{
    public function up()
    {
        Schema::create('primes', function (Blueprint $table) {
            $table->bigIncrements('id_prime'); // Clé primaire
            $table->unsignedBigInteger('employee_id'); // Clé étrangère vers employees
            $table->decimal('amount', 10, 2); // Montant de la prime
            $table->date('date_awarded'); // Date d’attribution de la prime
            $table->decimal('absence_factor', 5, 2)->default(1.00); // Facteur lié à l'absence
            $table->decimal('performance_factor', 5, 2)->default(1.00); // Facteur lié à la performance
            $table->timestamps(); // Champs created_at et updated_at

            // Relation avec la table employees
            $table->foreign('employee_id')
                  ->references('employee_id')
                  ->on('employees')
                  ->onDelete('cascade');

            // Ajout d'index pour les recherches fréquentes
            $table->index(['date_awarded']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('primes');
    }
}
