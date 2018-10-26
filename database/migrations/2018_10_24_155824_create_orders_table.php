<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state');
            $table->integer('pay_method');
            $table->string('payment',100);
            $table->string('message',100);
            $table->integer('ship_method');
            $table->string('ship_information',100);
            $table->string('ship_order',20);
            $table->json('products');
            $table->string('receiver',30);
            $table->string('receiver_phone',10);
            $table->string('invoice_number',10);
            $table->string('coupon',30);
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
        Schema::dropIfExists('orders');
    }
}
