<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('editor_id')->unsigned()->nullable()->index();

            $table->string('title');
            $table->longText('body')->nullable();
            $table->text('slogan')->nullable();

            $table->enum('status', ['draft', 'hidden', 'published'])->default('draft');
            $table->dateTime('publish_at')->nullable();
            $table->dateTime('hide_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
