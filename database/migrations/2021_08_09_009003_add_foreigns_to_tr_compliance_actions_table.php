<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToTrComplianceActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_compliance_actions', function (Blueprint $table) {
            $table
                ->foreign('compliance_id')
                ->references('id')
                ->on('tr_compliances')
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
        Schema::table('tr_compliance_actions', function (Blueprint $table) {
            $table->dropForeign(['compliance_id']);
        });
    }
}
