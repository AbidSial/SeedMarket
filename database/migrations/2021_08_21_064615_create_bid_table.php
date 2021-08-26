<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
             $table->increments('id')->primary();
			 $table->string('amount');
			 $table->string('seed_amount');
			 $table->string('seed_weight');
			 $table->unsignedInteger('seed_id');
			 $table->foreign('seed_id')->references('seed_id')->on('seeds')->onDelete('cascade');
             $table->unsignedBigInteger('user_id');
			 $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			 $table->boolean('ststus')->default(false);
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
        Schema::dropIfExists('bid');
    }
}
