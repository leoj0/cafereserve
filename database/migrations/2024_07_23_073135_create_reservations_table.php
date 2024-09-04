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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservation_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('table_id');
            $table->unsignedBigInteger('cafe_id');
            $table->date('reservation_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('guest_number');
            $table->text('special_request')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'canceled'])->default('pending');
            $table->timestamps();
            
            //Foreign Key
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('table_id')->references('table_id')->on('tables')->onDelete('cascade');
            $table->foreign('cafe_id')->references('cafe_id')->on('cafes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['table_id']);
            $table->dropForeign(['cafe_id']);
        });
        
        Schema::dropIfExists('reservations');
    }
};
