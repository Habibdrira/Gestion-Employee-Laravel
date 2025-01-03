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
        // Vérifie si la table 'loans' existe déjà pour éviter la recréation
        if (!Schema::hasTable('loans')) {
            Schema::create('loans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade'); // L'utilisateur qui a demandé le prêt
                $table->double('amount'); // Montant du prêt
                $table->string('reason')->nullable(); // Raison du prêt
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Statut du prêt

                // Clé étrangère explicitement définie
                $table->unsignedBigInteger('admin_id')->nullable();
                $table->foreign('admin_id')->references('admin_id')->on('admins')->onDelete('set null');

                $table->timestamps(); // Colonnes created_at et updated_at
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
