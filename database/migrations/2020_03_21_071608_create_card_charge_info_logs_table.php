<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardChargeInfoLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_charge_info_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('adminAccount');
            $table->string('userAccount');
            $table->string('cardType');
            $table->float('value');
            $table->float('realValue');
            $table->datetime('dateUpdate');
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
        Schema::dropIfExists('card_charge_info_logs');
    }
}
