<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressUserForeignKeyCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		
		Schema::table('addresses', function($table) {
			$table->dropForeign('addresses_user_id_foreign');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_address_user_foreign_key__cascade');
    }
}
