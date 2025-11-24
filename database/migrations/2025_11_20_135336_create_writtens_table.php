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
        Schema::create('writtens', function (Blueprint $table) {
            $table->id();
            $table->string('question_name');
            $table->longText('answer');
            $table->string('image');
            $table->unsignedInteger('quizcategory_id');
            $table->unsignedInteger('quizsubcategory_id');
            $table->unsignedInteger('written_category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('writtens');
    }
};
