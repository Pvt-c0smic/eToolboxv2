<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrComplianceActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_compliance_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('compliance_id');
            $table->longText('action_taken');
            $table->longText('commander_comment');
            $table->double('percentage');
            $table->date('updated_date');

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
        Schema::dropIfExists('tr_compliance_actions');
    }
}
