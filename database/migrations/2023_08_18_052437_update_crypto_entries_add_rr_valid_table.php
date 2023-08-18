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
            $table->float('risk_reward_valid')->nullable()->after('risk_reward');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crypto_entries', function (Blueprint $table) {
            $table->dropColumn('risk_reward_valid');
        });
    }
};
