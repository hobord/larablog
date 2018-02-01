<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('content_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('categorizable_type');
			$table->integer('category_id')->unsigned();
			$table->integer('content_id')->unsigned();
			$table->integer('weight')->nullable();
		});

        Schema::table('content_categories', function(Blueprint $table) {
            $table->index(['category_id']);
            $table->index(['content_id']);
            $table->index(['categorizable_type', 'category_id']);
        });
    }

	public function down()
	{
		Schema::drop('content_categories');
	}
}