<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialsTable extends Migration
{
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('job_title')->nullable();
            $table->string('company')->nullable();
            $table->string('photo')->nullable();
            $table->integer('rank')->default(0)->index();
            $table->text('testimonial_content');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('testimonials');
    }
}
