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
            $table->string('exception', 255);
            $table->text('message');
            $table->unsignedSmallInteger('code');
            $table->string('file', 255);
            $table->unsignedMediumInteger('line');
            $table->string('severity', 255)->nullable();
            $table->mediumText('trace');
            $table->string('user_agent', 255);
            $table->string('referer', 255)->nullable();
            $table->string('ip', 50);
            $table->string('port', 50);
            $table->string('uri', 500)->nullable();
            $table->mediumText('request')->nullable();
            $table->string('method', 50)->nullable();
            $table->string('route', 255)->nullable();
            $table->string('route_action', 255)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->boolean('checked');
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
