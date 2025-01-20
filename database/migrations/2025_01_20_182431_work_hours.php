<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('work_hours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('work_date');  // Date du travail
            $table->float('hours_worked', 8, 2);  // Heures de travail effectuées
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_hours');
    }
};
