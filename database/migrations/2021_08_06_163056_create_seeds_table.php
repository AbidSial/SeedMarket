<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seeds', function (Blueprint $table) {
			 $table->increments('seed_id', 30)->primary();
			 $table->string('analysis_report_image');
			 $table->string('seed_image');
			 $table->string('seed_kind');
			 $table->string('lot_number');
			 $table->string('seed_variety');
			 $table->string('total_seed_weight');
			 $table->string('price_per_pound');
			 $table->double('seed_purity');
			 $table->double('other_crop_seed_percentage');
			 $table->double('other_crop_seed_amount');
			 $table->double('weed_seed_percentage');
			 $table->double('germination_persontage');
			 $table->Integer('address_id');
			 //$table->foreign('address_id')->references('address_id')->on('addresses');	  
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
        Schema::dropIfExists('seeds');
    }
}
