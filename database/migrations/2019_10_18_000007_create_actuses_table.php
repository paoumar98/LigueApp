<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActusesTable extends Migration
{
    public function up()
    {
        Schema::create('actuses', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');

            $table->longText('content');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
