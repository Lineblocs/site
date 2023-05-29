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
            $table->string('app_logo')->default('');
            $table->string('app_icon')->default('');
            $table->string('alt_app_logo')->default('');
            $table->string('admin_portal_logo')->default('');
            $table->string('color_scheme')->default('');
            $table->string('layout_type')->default('');
            $table->string('grid_size')->default('');
            $table->string('primary_font')->default('');
            $table->string('secondary_font')->default('');
            $table->string('site_name')->default('');

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
