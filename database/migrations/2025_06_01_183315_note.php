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
        Schema::create('notes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('ue_id')->constrained('ues');
    $table->enum('session_type', ['normal', 'rattrapage']);
    $table->string('academic_year');
    $table->string('file_path'); // Stores path to Excel file
    $table->foreignId('professor_id')->constrained('utilisateurs');
    $table->timestamps();
    
    $table->index(['ue_id', 'academic_year', 'session_type']);
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
