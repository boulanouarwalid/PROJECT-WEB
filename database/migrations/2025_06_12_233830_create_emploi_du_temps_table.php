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
            $table->foreignId('ue_id')->constrained('ues')->onDelete('cascade');
            $table->foreignId('enseignant_id')->constrained('utilisateurs')->onDelete('cascade');
            $table->foreignId('salle_id')->constrained('salles')->onDelete('cascade');
            $table->foreignId('niveau_id')->constrained('niveaux')->onDelete('cascade');
            $table->enum('jour', ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi']);
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->enum('type_cours', ['cours', 'td', 'tp']);
            $table->string('annee_universitaire');
            $table->integer('semaine')->nullable();
            $table->text('remarques')->nullable();
            $table->timestamps();

            // Index for better performance
            $table->index(['jour', 'heure_debut']);
            $table->index(['ue_id', 'annee_universitaire']);
            $table->index(['enseignant_id', 'jour']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emploi_du_temps');
    }
};
