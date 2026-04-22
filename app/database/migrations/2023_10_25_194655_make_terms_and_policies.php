<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeTermsAndPolicies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms_and_policies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('privacy_policy')->default('');
            $table->text('terms_of_service')->default('');
            $table->text('service_level_agreement')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('terms_and_policies');
    }
}
