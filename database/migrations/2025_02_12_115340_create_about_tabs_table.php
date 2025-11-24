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
        Schema::create('about_tabs', function (Blueprint $table) {
            $table->id();
            $table->string('about_photo')->nullable();
            $table->longText('about_text')->nullable();
            $table->longText('educational')->nullable();
            $table->longText('work_profile')->nullable();
            $table->longText('academic')->nullable();
            $table->longText('achievements')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_tabs');
    }
};
