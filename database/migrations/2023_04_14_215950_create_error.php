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
        Schema::create('error', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('exception', 255)->nullable();
            $table->text('message')->nullable();
            $table->unsignedSmallInteger('code')->nullable();
            $table->string('file', 255)->nullable();
            $table->unsignedMediumInteger('line')->nullable();
            $table->string('severity', 255)->nullable();
            $table->mediumText('trace')->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->string('referer', 255)->nullable();
            $table->string('ip', 50)->nullable();
            $table->string('port', 50)->nullable();
            $table->string('uri', 500)->nullable();
            $table->mediumText('request')->nullable();
            $table->string('method', 50)->nullable();
            $table->string('route', 255)->nullable();
            $table->string('route_action', 255)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('checked')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('error');
    }
};
