<?php
// Migration pour créer la table `work_minutes` dans database/migrations/YYYY_MM_DD_create_work_minutes_table.php

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
        Schema::create('work_minutes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('minutes_worked'); // Nombre de minutes travaillées
            $table->enum('day', range(1, 31))->comment('Jour du mois');
            $table->timestamps();
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
