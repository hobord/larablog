<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuItemsTable extends Migration {

	public function up()
	{
		Schema::create('menu_items', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('parent_id')->unsigned()->nullable();
			$table->integer('menu_id')->unsigned();
			$table->string('title');
			$table->integer('weight')->default(0);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('menu_items');
	}
}