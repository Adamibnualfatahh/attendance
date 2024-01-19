<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnualLeaveDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annual_leave_dates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('annual_leave_id');
            $table->date('leave_date');
            $table->timestamps();

            $table->foreign('annual_leave_id')->references('id')->on('annual_leaves');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annual_leave_dates');
    }
}
