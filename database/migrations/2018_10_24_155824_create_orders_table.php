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
            $table->integer('pay_method')->nullable();
            $table->json('payment_information')->nullable();
            $table->string('message',100);
            $table->integer('ship_method')->nullable();
            $table->string('ship_information',100)->nullable();
            $table->string('ship_order',20)->nullable();
            $table->json('products');
            $table->string('receiver',30);
            $table->string('receiver_phone',10)->nullable();
            $table->string('invoice_number',10)->nullable();
            $table->string('coupon',30);
            $table->integer('member_id');
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
