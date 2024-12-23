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
    Schema::create('demande_conges', function (Blueprint $table) {
        $table->id('id_conge');
        $table->unsignedBigInteger('employee_id'); // FK vers la table 'employee'
        $table->date('date_debut');
        $table->date('date_fin');
        $table->string('type', 30);
        $table->string('commentaire', 100);
        $table->string('statut', 30);
        $table->timestamps();

        $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_conges');
    }
};
