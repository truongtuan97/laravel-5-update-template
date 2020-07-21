<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->string("orderID")->unique();
            $table->string('baokim_txn_id')->nullable();
            $table->double('total_amount')->nullable();
            $table->double('ingame_amount')->nullable();
            $table->string('bank_id')->nullable();
            $table->string('status')->nullable();
            $table->integer('success')->nullable();
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
        Schema::dropIfExists('bank_histories');
    }
}
