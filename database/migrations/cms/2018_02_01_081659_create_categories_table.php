<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('parent_id')->unsigned()->nullable()->index();
			$table->integer('catalog_id')->unsigned()->index();
			$table->string('name');
			$table->integer('weight')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}