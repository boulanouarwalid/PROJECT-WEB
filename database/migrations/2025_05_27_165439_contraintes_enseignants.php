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
        Schema::create('groupes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('niveau_id')->constrained('niveaux');
        $table->string('nom'); // G1, G2, TP1, TP2, etc.
        $table->string('type'); // 'td' or 'tp'
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
