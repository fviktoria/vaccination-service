<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateVaccinationsTable
 * table for saving vaccination dates
 */

class CreateVaccinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
			$table->integer('maxPatients');
            $table->date('date');
            $table->time('from');
            $table->time('to');
			$table->bigInteger('location_id')->unsigned();
			$table->foreign('location_id')
				->references('id')->on('locations')
				->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vaccinations');
    }
}
