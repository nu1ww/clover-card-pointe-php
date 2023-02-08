<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transaction_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('method');
            $table->text('endpoint');
            $table->text('request');
            $table->text('response');
            //$table->integer('http_status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaction_logs');
    }
}