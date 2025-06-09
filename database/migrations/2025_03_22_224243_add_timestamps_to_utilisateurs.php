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
    Schema::table('utilisateurs', function (Blueprint $table) {
        $table->timestamps(); // Ajoute les colonnes created_at et updated_at
    });
}

public function down()
{
    Schema::table('utilisateurs', function (Blueprint $table) {
        $table->dropTimestamps(); // Supprime les colonnes created_at et updated_at
    });
}

};
