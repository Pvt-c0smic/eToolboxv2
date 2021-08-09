<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToRfPersonnelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rf_personnel', function (Blueprint $table) {
            $table
                ->foreign('rank_id')
                ->references('id')
                ->on('rf_ranks')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('bos_id')
                ->references('id')
                ->on('rf_bos')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('office_id')
                ->references('id')
                ->on('rf_offices')
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
        Schema::table('rf_personnel', function (Blueprint $table) {
            $table->dropForeign(['rank_id']);
            $table->dropForeign(['bos_id']);
            $table->dropForeign(['office_id']);
        });
    }
}
