<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{

        Schema::table('menu_items', function(Blueprint $table) {
            $table->foreign('menu_id')->references('id')->on('menus')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('categories', function(Blueprint $table) {
            $table->foreign('catalog_id')->references('id')->on('catalogs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('content_categories', function(Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

		Schema::table('contents', function(Blueprint $table) {
			$table->foreign('editor_id')->references('id')->on('users')
						->onDelete('set null')
						->onUpdate('cascade');
		});

		Schema::table('articles', function(Blueprint $table) {
			$table->foreign('editor_id')->references('id')->on('users')
						->onDelete('set null')
						->onUpdate('cascade');
		});

		Schema::table('pages', function(Blueprint $table) {
			$table->foreign('editor_id')->references('id')->on('users')
						->onDelete('set null')
						->onUpdate('cascade');
		});

		Schema::table('guides', function(Blueprint $table) {
			$table->foreign('editor_id')->references('id')->on('users')
						->onDelete('set null')
						->onUpdate('cascade');
		});

		Schema::table('guide_chapters', function(Blueprint $table) {
			$table->foreign('editor_id')->references('id')->on('users')
						->onDelete('set null')
						->onUpdate('cascade');
		});

		Schema::table('infographics', function(Blueprint $table) {
			$table->foreign('editor_id')->references('id')->on('users')
						->onDelete('set null')
						->onUpdate('cascade');
		});

        Schema::table('content_metatags', function(Blueprint $table) {
            $table->foreign('metatag_id')->references('id')->on('metatags')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

	}

	public function down()
	{
		Schema::table('content_metatags', function(Blueprint $table) {
			$table->dropForeign('content_metatags_metatag_id_foreign');
		});
		Schema::table('infographics', function(Blueprint $table) {
			$table->dropForeign('infographics_editor_id_foreign');
		});
		Schema::table('guide_chapters', function(Blueprint $table) {
			$table->dropForeign('guide_chapters_editor_id_foreign');
		});
		Schema::table('guides', function(Blueprint $table) {
			$table->dropForeign('guides_editor_id_foreign');
		});
		Schema::table('pages', function(Blueprint $table) {
			$table->dropForeign('pages_editor_id_foreign');
		});
		Schema::table('articles', function(Blueprint $table) {
			$table->dropForeign('articles_editor_id_foreign');
		});
		Schema::table('contents', function(Blueprint $table) {
			$table->dropForeign('contents_editor_id_foreign');
		});
		Schema::table('content_categories', function(Blueprint $table) {
			$table->dropForeign('content_categories_category_id_foreign');
		});
		Schema::table('categories', function(Blueprint $table) {
			$table->dropForeign('categories_catalog_id_foreign');
		});
		Schema::table('menu_items', function(Blueprint $table) {
			$table->dropForeign('menu_items_menu_id_foreign');
		});
	}
}