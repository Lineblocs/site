<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitorComparisonTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Update your existing 'competitors' table with new UI/Content fields
        Schema::table('competitors', function (Blueprint $table) {
            // Check if fields exist before adding to prevent errors during migration
            if (!Schema::hasColumn('competitors', 'slug')) {
                $table->string('slug')->unique()->after('name');
            }
            $table->string('logo_url')->nullable()->after('slug');
            $table->string('brand_color')->nullable(); // Hex code for brand styling
            $table->text('intro_heading')->nullable(); // Page H1: "The #1 Alternative to..."
            $table->text('intro_body')->nullable();    // Intro paragraph
            $table->string('cta_link')->nullable();    // Custom signup link per competitor
        });

        // 2. Categories Table
        Schema::create('competitors_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('competitor_id')->unsigned();
            $table->string('name'); // e.g., "AI & Automation"
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->foreign('competitor_id')
                  ->references('id')->on('competitors')
                  ->onDelete('cascade');
        });

        // 3. Features Comparison Table
        Schema::create('competitors_features', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('competitor_id')->unsigned();
            $table->integer('category_id')->unsigned();
            
            $table->string('label'); // e.g., "Call Quality"
            
            // Your Service Data
            $table->text('our_value');
            $table->boolean('our_is_positive')->default(1); 
            
            // Competitor Data
            $table->text('their_value');
            $table->boolean('their_is_positive')->default(0);
            
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->foreign('competitor_id')
                  ->references('id')->on('competitors')
                  ->onDelete('cascade');

            $table->foreign('category_id')
                  ->references('id')->on('competitors_categories')
                  ->onDelete('cascade');
        });

        // 4. Testimonials Table
        Schema::create('competitors_testimonials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('competitor_id')->unsigned();
            $table->string('customer_name');
            $table->string('customer_title')->nullable(); // e.g., "VP of Sales"
            $table->string('customer_logo')->nullable();
            $table->text('quote');
            $table->timestamps();

            $table->foreign('competitor_id')
                  ->references('id')->on('competitors')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop sub-tables first to avoid FK constraints
        Schema::dropIfExists('competitors_testimonials');
        Schema::dropIfExists('competitors_features');
        Schema::dropIfExists('competitors_categories');

        // Remove the columns added to the main table
        Schema::table('competitors', function (Blueprint $table) {
            $table->dropColumn([
                'slug', 
                'logo_url', 
                'brand_color', 
                'intro_heading', 
                'intro_body', 
                'cta_link'
            ]);
        });
    }
}