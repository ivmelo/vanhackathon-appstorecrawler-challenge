<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('developer');
            $table->string('icon_url');
            $table->text('description');
            $table->string('price');
            $table->string('category');
            $table->date('last_updated');
            $table->string('version');
            $table->string('languages');
            $table->string('copyright');
            $table->double('rating');
            $table->integer('rating_count');
            $table->enum('os', ['android', 'ios']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apps');
    }
}
