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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->morphs('profilable');
            $table->string('phone_no')->unique();
            $table->foreignId('city_id')->constrained();
            $table->foreignId('township_id')->constrained();
            $table->json('address');
            $table->json('cover_photo')->nullable();
            $table->json('profile_picture')->nullable();
            $table->text('bio')->nullable();
            $table->json('socials')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
