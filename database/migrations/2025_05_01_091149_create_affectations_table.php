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
        Schema::create('affectations', function (Blueprint $table) {
            $table->id();
            $table->string('annee_universitaire',9);
            $table->enum('status',['brouillon', 'confirmée', 'archivée']);
            $table->foreignId('prof_id')->constrained('utilisateurs')->cascadeOnDelete();
            $table->foreignId('ue_id')->constrained('ues')->cascadeOnDelete();
            $table->foreignId('affecter_par')->constrained('utilisateurs')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affectations');
    }
};
