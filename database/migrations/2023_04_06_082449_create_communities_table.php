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
        Schema::create('communities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('community_category_id')->constrained();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('image_url');
            $table->string('image_name')->nullable();
            $table->string('image_type')->nullable();
            $table->string('image_size')->nullable();
            $table->dateTime('image_uploaded_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communities');
    }
};
