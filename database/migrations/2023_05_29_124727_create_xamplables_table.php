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
        Schema::create('xamplables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('xample_id');
            $table->char('xamplable_id', 26);
            $table->string('xamplable_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xamplables');
    }
};
