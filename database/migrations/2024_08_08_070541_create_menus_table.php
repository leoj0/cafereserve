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
        Schema::create('menus', function (Blueprint $table) {
            $table->id('menu_id');
            $table->unsignedBigInteger('cafe_id');
            $table->string('item_name');
            $table->longText('item_description')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('item_image')->nullable();
            $table->timestamps();

            // Foreign key to cafes table
            $table->foreign('cafe_id')->references('cafe_id')->on('cafes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
