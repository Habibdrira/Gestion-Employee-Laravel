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
    Schema::create('performances', function (Blueprint $table) {
        $table->id('id_performance');
        $table->unsignedBigInteger('employee_id'); 
        $table->double('rating');
        $table->date('date');
        $table->timestamps();

        $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');

        $table->index(['employee_id', 'date']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performances');
    }
};
