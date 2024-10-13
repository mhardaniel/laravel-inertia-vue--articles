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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title');
            $table->string('link');
            $table->date('date');
            $table->text('content');
            $table->enum('status', ['for-edit', 'published']);
            $table->foreignId('writer')
                ->constrained(
                    'users')
                ->onDelete('cascade');
            $table->foreignId('editor')->nullable()
                ->constrained(
                    'users'
                )
                ->onDelete('cascade');
            $table->foreignId('company')
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
