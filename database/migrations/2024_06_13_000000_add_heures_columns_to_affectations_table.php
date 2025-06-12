<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHeuresColumnsToAffectationsTable extends Migration
{
    public function up()
    {
        Schema::table('affectations', function (Blueprint $table) {
            $table->integer('heures_cm')->default(0);
            $table->integer('heures_td')->default(0);
            $table->integer('heures_tp')->default(0);
        });
    }

    public function down()
    {
        Schema::table('affectations', function (Blueprint $table) {
            $table->dropColumn(['heures_cm', 'heures_td', 'heures_tp']);
        });
    }
}
