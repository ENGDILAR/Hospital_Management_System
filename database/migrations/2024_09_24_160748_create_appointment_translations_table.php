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
        Schema::create('appointment_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->default('ar');
            $table->string('name');
            $table->unique(['appointment_id','locale']);
            $table->foreignId('appointment_id')->references('id')->on('appointments')->onDelete('cascade');// one delete to delete from the tow tabels if deleted in one 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_translations');
    }
};
