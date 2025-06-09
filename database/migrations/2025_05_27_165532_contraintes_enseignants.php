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
        Schema::create('groupe_enseignements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('affectation_id')->constrained('affectations');
            $table->foreignId('groupe_id')->constrained('groupes'); // Reference to predefined group
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
