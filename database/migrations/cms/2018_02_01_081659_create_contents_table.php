<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentsTable extends Migration {

	public function up()
	{
		Schema::create('contents', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('editor_id')->unsigned()->nullable()->index();

            $table->string('title');
            $table->longText('body')->nullable();

            $table->enum('status', ['draft', 'hidden', 'published'])->default('draft');
            $table->dateTime('publish_at')->nullable();
            $table->dateTime('hide_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('contents');
	}
}