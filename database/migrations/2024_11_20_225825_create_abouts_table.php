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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('last_name');

            $table->string('phone')->unique()->nullable();
            $table->date('birth_date')->nullable();
            //$table->integer('age')->nullable();
            $table->string('avatar')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();

            $table->string('job')->nullable();
            $table->string('degree')->nullable();
            $table->string('experience')->nullable();

            $table->string('title');
            $table->text('description');
            //$table->string('image');
            $table->string('header_image')->nullable();
            //$table->string('video')->nullable(); 
            $table->string('cv')->nullable();

            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('github')->nullable();
            $table->string('youtube')->nullable();
            $table->string('website')->nullable();

            $table->string('email')->nullable();

            $table->json('social_links')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->json('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
