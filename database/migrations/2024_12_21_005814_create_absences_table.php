<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsencesTable extends Migration
{
    public function up()
    {
          Schema::create('absences', function (Blueprint $table) {
            $table->id('id_absence'); // Utilise auto-increment comme dans le SQL
            $table->date('date');
            $table->string('reason', 200);
            $table->integer('duration');
            $table->unsignedBigInteger('employee_id'); // Il s'agit d'une clé étrangère
            $table->timestamps();

            $table->foreign('employee_id')->references('employee_id')->on('employees'); // Définition de la contrainte FK
        });


    }

    public function down()
    {
        Schema::dropIfExists('absences');
    }
}

