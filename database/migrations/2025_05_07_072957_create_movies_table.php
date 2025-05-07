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
        $table->id(); // bigint(20) unsigned auto_increment
        $table->string('title', 255);
        $table->string('slug', 255);
        $table->text('synopsis');
        $table->unsignedBigInteger('category_id'); // foreign key
        $table->year('year');
        $table->text('actors')->nullable();
        $table->string('cover_image', 255)->nullable();
        $table->timestamps();

        // foreign key constraint
        $table->foreign('category_id')->references('id')->on('categories');
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
