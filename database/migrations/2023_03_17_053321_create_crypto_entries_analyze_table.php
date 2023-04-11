<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('crypto_entries_analyze', function (Blueprint $table) {
            $table->id();
            $table->enum('double_bot', ['d', 'h4', 'h1', 'm30', 'm15', 'm5'])->nullable();
            $table->enum('double_top', ['d', 'h4', 'h1', 'm30', 'm15', 'm5'])->nullable();
            $table->enum('divergence', ['d', 'h4', 'h1', 'm30', 'm15', 'm5'])->nullable();
            $table->enum('bulle', ['d', 'h4', 'h1', 'm30', 'm15', 'm5'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_entries_analyze');
    }
};
