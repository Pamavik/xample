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
        Schema::create('xamples', function (Blueprint $table) {
            $table->id();
            $table->char('teacher_id', 26)->cascadeOnDelete()->references('id')->on('users');
            $table->string('title');
            $table->text('description');
            $table->json('items');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xamples');
    }
};
