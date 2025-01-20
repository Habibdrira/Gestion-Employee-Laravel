<?php
// Migration pour ajouter 'status_user' dans la table 'users' (database/migrations/YYYY_MM_DD_add_status_user_to_users.php)

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusUserToUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('status_user')->default('offline'); // Ajouter une colonne `status_user`
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status_user'); // Supprimer la colonne `status_user`
        });
    }
}
