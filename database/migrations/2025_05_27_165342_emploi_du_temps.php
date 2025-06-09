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
        Schema::create('contraintes_salles', function (Blueprint $table) {
    $table->id();
    $table->foreignId('salle_id')->constrained('salles')->cascadeOnDelete();
    $table->enum('jour', ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi']);
    $table->time('heure_debut');
    $table->time('heure_fin');
    $table->string('raison');
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
