<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusTable extends Migration {

	public function up()
	{
		Schema::create('menus', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
			$table->softDeletes();
			$table->enum('type', array('system', 'cms'))->default('cms');
		});
	}

	public function down()
	{
		Schema::drop('menus');
	}
}