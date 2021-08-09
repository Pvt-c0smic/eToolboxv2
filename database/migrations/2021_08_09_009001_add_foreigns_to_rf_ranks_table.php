<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToRfRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rf_ranks', function (Blueprint $table) {
            $table
                ->foreign('personnel_type_id')
                ->references('id')
                ->on('rf_personnel_types')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rf_ranks', function (Blueprint $table) {
            $table->dropForeign(['personnel_type_id']);
        });
    }
}
