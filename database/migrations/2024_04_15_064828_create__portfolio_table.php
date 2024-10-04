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
        Schema::create('_portfolio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('depositOperation_id');
            $table->string('amount');
            $table->string('operationType');
            $table->integer('cardId')->nullable();
            $table->string('expirationDate')->nullable();
            $table->integer('CVVcode')->nullable();
            $table->string('cardUser')->nullable();
            $table->string('bankName')->nullable();
            $table->integer('accountId')->nullable();
            $table->string('transferDate')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_portfolio');
    }
};
