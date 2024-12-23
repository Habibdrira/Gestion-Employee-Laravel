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
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employee_id'); // Clé primaire
            $table->unsignedBigInteger('user_id')->unique(); // Clé étrangère vers 'users'
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('position')->nullable();
            $table->decimal('salary', 8, 2)->nullable();
            $table->timestamps();

            // Définir la relation de clé étrangère
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
