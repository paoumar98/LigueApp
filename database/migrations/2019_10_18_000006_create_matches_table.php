<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');

            $table->datetime('start_time');

            $table->decimal('ticket', 15, 2);

            $table->integer('result_h');

            $table->integer('result_a');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
