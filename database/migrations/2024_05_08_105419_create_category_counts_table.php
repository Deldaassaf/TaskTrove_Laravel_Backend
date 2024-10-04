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
        Schema::create('category_counts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categories_id')->unsigned();
            $table->integer('count');
            $table->foreign('categories_id')->references('id')->on('categories')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_counts');
    }
};
