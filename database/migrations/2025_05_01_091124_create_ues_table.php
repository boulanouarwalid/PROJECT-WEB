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
        Schema::create('ues', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('code',10);
            $table->integer('heures_cm')->default('0');
            $table->integer('heures_td')->default('0');
            $table->integer('heures_tp')->default('0');
            $table->enum('semestre',['S1','S2','S3','S4','S5','S6']);
            $table->string('annee_universitaire',9);
            $table->boolean('est_vacant');
            $table->integer('groupes_td')->default('0');
            $table->integer('groupes_tp')->default('0');
            $table->foreignId('filiere_id')->constrained('filieres')->cascadeOnDelete();
            $table->foreignId('department_id')->constrained('departements')->cascadeOnDelete();
            $table->foreignId('responsable_id')->constrained('utilisateurs')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ues');
    }
};
