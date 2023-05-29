<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldsToCustomizations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customizations', function (Blueprint $table) {
            $table->string('facebook_url');
            $table->boolean('facebook_enabled')->default(FALSE);
            $table->string('instagram_url');
            $table->boolean('intagram_enabled')->default(FALSE);
            $table->string('twitter_url');
            $table->boolean('twitter_enabled')->default(FALSE);
            $table->string('tiktok_url');
            $table->boolean('tiktok_enabled')->default(FALSE);
            $table->string('linkedin_url');
            $table->boolean('linkedin_enabled')->default(FALSE);
            $table->text('privacy_policy');
            $table->text('terms_of_service');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
