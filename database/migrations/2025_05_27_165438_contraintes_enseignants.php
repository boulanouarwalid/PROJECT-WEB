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
        Schema::create('niveaux', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // e.g., "L1", "L2", "L3"
            $table->foreignId('filiere_id')
                ->constrained('filieres')
                ->cascadeOnDelete();
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
