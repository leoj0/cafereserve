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
        Schema::create('tables', function (Blueprint $table) {
            $table->id('table_id');
            $table->unsignedBigInteger('cafe_id');
            $table->integer('table_number')->unique();
            $table->integer('seating_capacity');
            $table->string('position')->nullable();
            $table->boolean('is_bookable')->default(true);
            $table->timestamps();

            $table->foreign('cafe_id')->references('cafe_id')->on('cafes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
