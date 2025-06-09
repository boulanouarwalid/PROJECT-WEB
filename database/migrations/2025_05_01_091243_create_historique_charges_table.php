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
        Schema::create('historique_charges', function (Blueprint $table) {
            $table->id();
            $table->integer('heures_totales');
            $table->integer('heures_cm')->default('0');
            $table->integer('heures_td')->default('0');
            $table->integer('heures_tp')->default('0');
            $table->string('annee_universitaire',9);
            $table->foreignId('prof_id')->constrained('utilisateurs')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_charges');
    }
};
