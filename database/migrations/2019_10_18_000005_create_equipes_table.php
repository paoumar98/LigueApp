<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipesTable extends Migration
{
    public function up()
    {
        Schema::create('equipes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('division');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
