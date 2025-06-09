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
        Schema::create('deparetement_maths', function (Blueprint $table) {
            $table->id();
            $table->integer('idProf'); 
            $table->string('Nomprof'); 
            $table->string('NomModule'); 
            $table->string('feliere'); 
            $table->string('niveaux'); 
            $table->integer('NombreHeurs'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deparetement_maths');
    }
};
