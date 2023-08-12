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
        Schema::table('crypto_entries', function (Blueprint $table) {
            $table->unsignedBigInteger('actif_advanced_id')->nullable()->after('zone_id');
        });
        Schema::table('crypto_entries', function (Blueprint $table) {
            $table->foreign('actif_advanced_id')->references('id')->on('crypto_entries_actif_advanced');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crypto_entries', function (Blueprint $table) {
            $table->dropForeign(['actif_advanced_id']);
            $table->dropColumn('actif_advanced_id');
        });
    }
};
