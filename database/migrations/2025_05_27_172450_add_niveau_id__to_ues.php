<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('ues', function (Blueprint $table) {
            // Add the column as nullable first if there's existing data
            $table->foreignId('niveau_id')->nullable()->constrained();
        });

        // Optional: Update existing records with default niveau_id
        // DB::table('ues')->update(['niveau_id' => 1]); // Example
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('ues', function (Blueprint $table) {
            $table->dropForeign(['niveau_id']);
            $table->dropColumn('niveau_id');
        });
    }
};
