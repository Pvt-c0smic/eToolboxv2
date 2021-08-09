<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrCompliancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_compliances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('office_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('project_name');
            $table->foreignId('status_id');

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
        Schema::dropIfExists('tr_compliances');
    }
}
