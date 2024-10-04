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
        Schema::create('cv', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employe_id');
            $table->string('name');
            $table->string('university');
            $table->string('mobileNumber');
            $table->string('email');
            $table->string('location');
            $table->string('DateOfBirth');
            $table->string('Nationality');
            $table->string('UniversityStartDate');
            $table->string('UniversityEndDate');
            $table->longtext('RecommendationLetter');
            $table->string('language1');
            $table->string('language2')->nullable();
            $table->string('language3')->nullable();
            $table->text('tecnicalSkills1');
            $table->text('tecnicalSkills2')->nullable();
            $table->text('tecnicalSkills3')->nullable();
            $table->text('softSkill1');
            $table->text('softSkill2')->nullable();
            $table->text('softSkill3')->nullable();
            $table->text('interests1');
            $table->text('interests2')->nullable();
            $table->text('courses1');
            $table->text('courses2')->nullable();
            $table->text('courses3')->nullable();
            $table->longtext('AboutYou');
            $table->text('educations');
            $table->string('specialization');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv');
    }
};
