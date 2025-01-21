<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 10, 2); // Montant de la vente
            $table->timestamps(); // Created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
