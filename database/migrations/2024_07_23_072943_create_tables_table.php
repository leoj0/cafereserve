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
            $table->integer('table_number');
            $table->integer('seating_capacity');
            $table->string('position')->nullable();
            $table->boolean('is_bookable')->default(true);
            $table->timestamps();
        
            // Foreign key for cafe_id
            $table->foreign('cafe_id')->references('cafe_id')->on('cafes')->onDelete('cascade');
        
            // Composite unique constraint for cafe_id and table_number
            $table->unique(['cafe_id', 'table_number']);
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
