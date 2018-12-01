<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventsTableColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('filter');
            $table->dropColumn('priority');
            $table->dropColumn('price_operation');
            $table->dropColumn('frequency_limit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->json('filter');
            $table->string('price_operation',45);
            $table->integer('frequency_limit')->default(0);
            $table->integer('priority')->default(0);
        });
    }
}
