<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('messages', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('sender_id')->unsigned();
      $table->integer('type');
      $table->string('title',80);
      $table->string('message',45);
      $table->integer('receiver_id')->unsigned();
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
    Schema::dropIfExists('messages');
  }
}
