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
        Schema::create('_employe', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('employeeName');
            $table->string('profileImage');
            $table->string('location');
            $table->string('employeeSpecialization');
            $table->string('employeeAcademicStatus');
            $table->string('employeeComunnicationTool');
            $table->integer('expectedSalary');
            $table->integer('yearsOfExperience');
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_eeSpecializatione');
    }
};
