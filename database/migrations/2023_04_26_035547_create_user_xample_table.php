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
        Schema::create('user_xample', function (Blueprint $table) {
            $table->id();
            $table->char('user_id', 26);
            $table->unsignedBigInteger('xample_id');
           // $table->foreignUlid('user_id')->references('id')->on('users');
            //$table->foreign('xample_id')->references('id')->on('xamples');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_xample');
    }
};
