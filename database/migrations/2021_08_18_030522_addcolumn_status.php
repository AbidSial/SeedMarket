<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddcolumnStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		 Schema::table('seeds', function($table) {
			$table->boolean('ststus')->default(false);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		Schema::table('status', function (Blueprint $table) {
            $table->drop('status');
        });
    }
}
