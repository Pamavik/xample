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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('xample_id')->references('id')->on('xamples');
            $table->char('user_id', 26)->cascadeOnDelete()->references('id')->on('users');
            $table->char('teacher_id', 26)->cascadeOnDelete()->references('id')->on('users');
            $table->integer('questions_count');
            $table->integer('errors_count');
            $table->json('errors_list');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
