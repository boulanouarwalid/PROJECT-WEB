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

        Schema::create('charge_horaires', function (Blueprint $table) {
        $table->id();
        $table->foreignId('affectation_id')->constrained('affectations')->cascadeOnDelete();
        $table->integer('volume_horaire');
        $table->integer('completed_hours')->default(0);
        $table->boolean('is_completed')->default(false);
        $table->text('commentaires')->nullable();
        $table->integer('heures_semaine');
        $table->date('date_debut');
        $table->date('date_fin')->nullable(); // sera calculé automatiquement
        $table->foreignId('groupe_id')
            ->nullable()
            ->constrained('groupe_enseignements')
            ->nullOnDelete();
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
