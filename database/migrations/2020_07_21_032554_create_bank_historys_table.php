<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankHistorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->string("orderID");
            $table->string('baokim_txn_id')->nullable();
            $table->double('total_amount')->nullable();
            $table->double('ingame_amount')->nullable();
            $table->string('bank_id');
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
