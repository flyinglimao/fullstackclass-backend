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
            $table->string('title',40)->default('測試title');
            $table->string('subtitle',60)->default('測試subtitle');
            $table->string('description',500)->default('測試description');
            $table->integer('type')->default(0);
            $table->string('author',30)->default('測試author');
            $table->string('publisher',30)->default('測試publisher');
            $table->string('isbn',13)->default('0000000000000');
            $table->integer('category_id')->default(0);
            $table->string('tags',60)->default('測試tags');
            $table->integer('list_price')->default(100);
            $table->integer('sale_price')->default(100);
            $table->integer('stock')->default(10);
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
