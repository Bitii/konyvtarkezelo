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
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('language', 255);
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->string('translated_title', 255);
            $table->text('translated_description')->nullable();
            $table->string('translated_genre', 255);
            $table->text('translated_keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
