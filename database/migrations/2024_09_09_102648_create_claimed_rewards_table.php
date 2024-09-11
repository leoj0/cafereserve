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
        Schema::create('claimed_rewards', function (Blueprint $table) {
            $table->id('claimed_reward_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cafe_id');
            $table->unsignedBigInteger('reward_id');
            $table->timestamp('claimed_at');
            $table->timestamp('used_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('cafe_id')->references('cafe_id')->on('cafes')->onDelete('cascade');
            $table->foreign('reward_id')->references('reward_id')->on('rewards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claimed_rewards');
    }
};
