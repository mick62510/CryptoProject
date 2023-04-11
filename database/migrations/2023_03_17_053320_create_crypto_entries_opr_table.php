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
        Schema::create('crypto_entries_opr', function (Blueprint $table) {
            $table->id();
            $table->enum('bullish_breakout', ['m5', 'm15'])->nullable();
            $table->enum('bearish_breakout', ['m5', 'm15'])->nullable();
            $table->enum('integration', ['m5', 'm15'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_entries_opr');
    }
};
