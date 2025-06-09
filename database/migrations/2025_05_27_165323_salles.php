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
        Schema::create('emploi_du_temps', function (Blueprint $table) {
    $table->id();
    $table->foreignId('ue_id')->constrained('ues')->cascadeOnDelete();
    $table->foreignId('enseignant_id')->constrained('utilisateurs')->cascadeOnDelete();
    $table->foreignId('salle_id')->constrained('salles')->cascadeOnDelete();
    $table->enum('type_seance', ['cours', 'td', 'tp']);
    $table->integer('groupe')->nullable(); // For TD/TP groups
    $table->enum('jour', ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi']);
    $table->time('heure_debut');
    $table->time('heure_fin');
    $table->enum('semestre', ['S1', 'S2', 'S3', 'S4', 'S5', 'S6']);
    $table->string('annee_universitaire', 9);
    $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
