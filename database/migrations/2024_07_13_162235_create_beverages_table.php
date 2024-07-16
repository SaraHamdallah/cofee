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
        Schema::create('beverages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content'); // Changed from string to text for larger content
            $table->decimal('price', 8, 2); // Changed to decimal for price with precision
            $table->boolean('published'); // Changed to boolean for published status
            $table->boolean('special'); // Changed to boolean for special status
            $table->string('image');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beverages');
    }
};
