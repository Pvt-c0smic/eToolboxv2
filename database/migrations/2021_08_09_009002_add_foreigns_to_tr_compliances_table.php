<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToTrCompliancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_compliances', function (Blueprint $table) {
            $table
                ->foreign('office_id')
                ->references('id')
                ->on('rf_offices')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('status_id')
                ->references('id')
                ->on('rf_statuses')
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
        Schema::table('tr_compliances', function (Blueprint $table) {
            $table->dropForeign(['office_id']);
            $table->dropForeign(['status_id']);
        });
    }
}
