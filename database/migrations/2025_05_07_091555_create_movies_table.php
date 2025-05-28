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
        Schema::create('movies', function (Blueprint $table) {
           $table->id();
           $table->string('title');
           $table->string('slug')->unique();
           $table->text('synopsis');
           $table->foreignId('category_id')->constrained();
           $table->year('release_year');
           $table->text('actors');
           $table->string('cover_image')->nullable();
           $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
