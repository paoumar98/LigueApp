<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToActusesTable extends Migration
{
    public function up()
    {
        Schema::table('actuses', function (Blueprint $table) {
            $table->unsignedInteger('division_id')->nullable();

            $table->foreign('division_id', 'division_fk_473270')->references('id')->on('equipes');
        });
    }
}
