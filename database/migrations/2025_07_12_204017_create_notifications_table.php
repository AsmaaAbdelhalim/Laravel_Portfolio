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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'admin_action', 'contact_message'
            $table->string('title');
            $table->text('message');
            $table->string('action_type')->nullable(); // 'create', 'update', 'delete'
            $table->string('model_type')->nullable(); // 'Project', 'Service', 'Contact', etc.
            $table->unsignedBigInteger('model_id')->nullable(); // ID of the affected model
            $table->unsignedBigInteger('user_id')->nullable(); // Admin who performed the action
            $table->boolean('is_read')->default(false);
            $table->json('data')->nullable(); // Additional data
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['type', 'is_read']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
