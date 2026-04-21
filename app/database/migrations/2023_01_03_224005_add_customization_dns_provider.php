<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomizationDnsProvider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customizations', function (Blueprint $table) {
            //
            $table->string('dns_provider', 64)->default('self-managed'); // self-managed, namecheap, route53, etc...
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customizations', function (Blueprint $table) {
            //
        });
    }
}
