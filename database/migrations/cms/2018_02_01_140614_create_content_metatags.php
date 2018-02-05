<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentMetatags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_metatags', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('metatag_id');
            $table->unsignedInteger('content_id');
            $table->string('content_type');
            $table->string('value');
            $table->timestamps();
        });

        Schema::table('content_metatags', function (Blueprint $table) {
            $table->unique(['metatag_id', 'content_model', 'content_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_metatags');
    }
}
