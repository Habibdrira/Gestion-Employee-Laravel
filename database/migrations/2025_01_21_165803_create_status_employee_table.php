<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('status_employee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); // Clé étrangère
            $table->enum('status', ['active', 'offline', 'busy'])
                  ->default('offline'); // Valeur par défaut
            $table->timestamp('start_time')->nullable(); // Heure de début
            $table->timestamp('end_time')->nullable();   // Heure de fin
            $table->timestamps();

            // Ajouter la clé étrangère
            $table->foreign('employee_id')
                  ->references('employee_id') // Référence correcte
                  ->on('employees')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_employee');
    }
};
