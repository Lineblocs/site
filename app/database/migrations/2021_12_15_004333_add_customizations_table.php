<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customizations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('app_logo', 128)->default('');
            $table->string('app_icon', 128)->default('');
            $table->string('alt_app_logo', 128)->default('');
            $table->string('admin_portal_logo', 128)->default('');
            $table->string('color_scheme', 128)->default('');
            $table->string('layout_type', 128)->default('');
            $table->string('grid_size', 128)->default('');
            $table->string('primary_font', 128)->default('');
            $table->string('secondary_font', 128)->default('');
            $table->string('site_name', 128)->default('');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customizations');
    }
}
