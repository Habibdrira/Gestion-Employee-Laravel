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
        Schema::create('work_minutes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); // Clé étrangère
            $table->integer('minutes_worked'); // Nombre de minutes travaillées
            $table->enum('day', [
                'Monday', 'Tuesday', 'Wednesday', 'Thursday', 
                'Friday', 'Saturday', 'Sunday'
            ])->comment('Jour de la semaine');
            $table->timestamps();

            // Définir la clé étrangère correctement
            $table->foreign('employee_id')
                  ->references('employee_id') // Nom exact de la clé primaire dans employees
                  ->on('employees')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_minutes');
    }
};
