<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBonusesTableColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bonuses', function (Blueprint $table) {
            $table->integer('user_id');
            $table->dropColumn('member_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bonuses', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->integer('member_id');
        });
    }
}
