<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWtcmembers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	Schema::create('wtcmembers', function($newtable) {
            $newtable->increments('id');
            $newtable->string('lastname');
            $newtable->string('adress');
            $newtable->string('town');
            $newtable->date('birthday');
            $newtable->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wtcmembers');
	}

}
