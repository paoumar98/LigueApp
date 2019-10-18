<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMatchesTable extends Migration
{
    public function up()
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->unsignedInteger('home_id');

            $table->foreign('home_id', 'home_fk_465044')->references('id')->on('equipes');

            $table->unsignedInteger('away_id');

            $table->foreign('away_id', 'away_fk_465045')->references('id')->on('equipes');

            $table->unsignedInteger('division_id');

            $table->foreign('division_id', 'division_fk_465055')->references('id')->on('equipes');
        });
    }
}
