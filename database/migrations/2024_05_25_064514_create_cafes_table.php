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
        Schema::create('cafes', function (Blueprint $table) {
            $table->id('cafe_id');
            $table->enum('status', ['Pending', 'Approved', 'Denied'])->default('Pending');
            $table->unsignedBigInteger('user_id');
            $table->string('cafe_name');
            $table->string('logo')->nullable();
            $table->string('phone_number');
            $table->string('cafe_tags');
            $table->string('location');
            $table->string('email');
            $table->longText('description');
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cafes');
    }
};
