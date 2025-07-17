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
        Schema::create('skill_languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['skill', 'language']);
            //$table->string('level')->nullable();
            $table->integer('percent')->nullable();
            $table->string('color')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('created_by')->nullable();
          //$table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->json('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_languages');
    }
};
