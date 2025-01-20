<?php
// Migration pour créer la table `status_user` (database/migrations/YYYY_MM_DD_create_status_user_table.php)

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
        Schema::create('status_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['active', 'offline', 'busy'])->default('offline'); // Valeur par défaut 'offline'
            $table->timestamp('start_time')->nullable(); // Heure de début
            $table->timestamp('end_time')->nullable();   // Heure de fin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_user');
    }
};
