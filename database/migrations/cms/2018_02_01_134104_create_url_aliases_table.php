<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrlAliasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_aliases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->string('route_to');
            $table->timestamps();
        });
        Schema::table('url_aliases', function (Blueprint $table) {
            $table->unique('path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url_aliases');
    }
}
