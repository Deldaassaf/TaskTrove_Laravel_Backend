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
        Schema::create('_job', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->string('jobName');
            $table->string('jobSpecialization');
            $table->string('jobLocation');
            $table->string('category');
            $table->longtext('jobDiscription');
            $table->longtext('jobRequirements');
            $table->integer('jobExperience');
            $table->string('jobHours');
            $table->integer('jobSalary');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_job');
    }
};
