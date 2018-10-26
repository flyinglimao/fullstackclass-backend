<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url',45);
            $table->string('title',45);
            $table->string('description',45);
            $table->string('hero_image',45);
            $table->string('side_image',45);
            $table->json('filter');
            $table->string('price_operation',45);
            $table->string('gift',45);
            $table->json('time_interval');
            $table->string('frequency_limit',45);
            $table->integer('priority');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
