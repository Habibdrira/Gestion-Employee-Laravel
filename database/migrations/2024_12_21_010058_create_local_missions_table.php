<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('local_missions', function (Blueprint $table) {
            $table->id(); // Clé primaire pour la table local_missions
            $table->unsignedBigInteger('employee_id'); // Ajoute la colonne employee_id pour la clé étrangère
            $table->foreign('employee_id') // Définit la clé étrangère
                  ->references('employee_id') // Référence la clé primaire de la table employees
                  ->on('employees')
                  ->onDelete('cascade');

            $table->string('mission_id')->unique();
            $table->string('superviseur');
            $table->string('region');
            $table->text('purpose');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('accompanying_person')->nullable();
            $table->string('license_plate')->nullable();
            $table->string('car_type')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('carte_carburant')->nullable();
            $table->decimal('distance_traveled', 8, 2)->nullable();
            $table->decimal('fuel_cost', 8, 2)->nullable();
            $table->decimal('toll_expenses', 8, 2)->nullable();
            $table->decimal('hotel', 8, 2)->nullable();
            $table->decimal('indemnity', 8, 2)->nullable();
            $table->decimal('total_cost', 8, 2)->nullable();
            $table->string('status')->default('pending');
            $table->text('report_details')->nullable();
            $table->date('report_date')->nullable();
            $table->string('receipt_path')->nullable();
            $table->timestamps();
        });



            }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('local_missions');
    }
};
