<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//to manage the language of your inputs
//php artisan make:migration create_section_tarnslations_table --create=section_translations
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('section_translations', function (Blueprint $table) {
     // mandatory fields
     $table->id(); // Laravel 5.8+ use bigIncrements() instead of increments()
       $table->string('locale')->default('ar');//the language that your input have been inserted  ar,en....

        // Foreign key to the main model
        $table->unique(['section_id', 'locale']);// to prevent duplicate a same value in the same language
        $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade'); //refeere to sections table
        $table->longText('description')->nullable();

           // Actual fields you want to translate
       $table->string('name');//the field from sections table that will be translatedd

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_translations');
    }
};
