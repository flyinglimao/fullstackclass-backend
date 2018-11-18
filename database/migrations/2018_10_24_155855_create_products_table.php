<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',40);
            $table->string('subtitle',60);
            $table->string('description',500);
            $table->integer('type');
            $table->string('author',30);
            $table->string('publisher',30);
            $table->string('isbn',13);
            $table->integer('category_id')->unsigned();
            $table->integer('subcategory_id')->unsigned();
            $table->string('tags',60);
            $table->integer('list_price');
            $table->integer('sale_price');
            $table->integer('stock');
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
        Schema::dropIfExists('products');
    }
}
