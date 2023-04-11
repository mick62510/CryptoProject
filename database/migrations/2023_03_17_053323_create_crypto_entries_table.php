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
        Schema::create('crypto_entries', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date', 0)->nullable(false);
            $table->char('actif_code', 20)->nullable(false);
            $table->unsignedBigInteger('data_id')->nullable(false);
            $table->unsignedBigInteger('opr_id')->nullable(false);
            $table->unsignedBigInteger('analyze_id')->nullable(false);
            $table->unsignedBigInteger('zone_id')->nullable(false);
            $table->unsignedBigInteger('user_id');
            $table->enum('result', ['win', 'loose', 'be'])->nullable();
            $table->enum('trend', ['buy', 'sell'])->nullable(false);
            $table->enum('trend_type', ['bullish', 'bearish', 'range'])->nullable(false);
            $table->mediumText('risk_reward')->nullable(false);
            $table->timestamps();
        });
        Schema::table('crypto_entries', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('actif_code')->references('code')->on('crypto_entries_actif')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('data_id')->references('id')->on('crypto_entries_data')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('opr_id')->references('id')->on('crypto_entries_opr')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('analyze_id')->references('id')->on('crypto_entries_analyze')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('zone_id')->references('id')->on('crypto_entries_zone')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_entries');
    }
};
