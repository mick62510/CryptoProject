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
        Schema::create('crypto_entries_zone', function (Blueprint $table) {
            $table->id();
            $table->enum('area_d', [true, false])->nullable();
            $table->enum('area_h4', [true, false])->nullable();
            $table->enum('area_h1', [true, false])->nullable();
            $table->enum('area_m30', [true, false])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_entries_zone');
    }
};
