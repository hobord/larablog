<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCatalogsTable extends Migration {

	public function up()
	{
		Schema::create('catalogs', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->enum('type', array('system', 'cms'))->index();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('catalogs');
	}
}