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
        Schema::create('wishes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('utilisateurs'); // Enseignant
            $table->foreignId('ue_id')->constrained('ues');
            $table->enum('type', ['Responsable', 'Intervenant', 'Supplementaire', 'Autre']);
            $table->text('message')->nullable();
            $table->enum('status', ['en attent', 'accepetee', 'refusee'])->default('en attent');
            $table->text('response')->nullable(); // Réponse du coordinateur
            $table->foreignId('responded_by')->nullable()->constrained('utilisateurs'); // Coordinateur
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishes');
    }
};
