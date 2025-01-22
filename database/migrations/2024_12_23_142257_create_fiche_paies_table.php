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
    Schema::create('fiche_paies', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('employee_id');  // Lien avec l'utilisateur
        $table->date('date'); // Mois et année de la fiche de paie
        $table->decimal('montant', 10, 2); // Montant du salaire
        $table->string('filename'); // Nom du fichier de la fiche de paie
        $table->timestamps();

        $table->foreign('employee_id')
        ->references('employee_id') // Référence correcte
        ->on('employees')
        ->onDelete('cascade');
});
    
}

public function down()
{
    Schema::dropIfExists('fiche_paies');
}

};
