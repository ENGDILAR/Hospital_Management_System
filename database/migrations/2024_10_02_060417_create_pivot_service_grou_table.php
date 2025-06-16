<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // a many to many relation sheap
        Schema::create('service_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreignId('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_group');
    }
};
