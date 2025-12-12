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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('status',['pending','accepted','rejected'])->default('pending');
            $table->float('aiGeneratedScore',2)->default(0);
            $table->mediumText('aiGeneratedFeedback');
            $table->timestamps();
            $table->softDeletes();

            $table->uuid('jobVacancy_id');
            $table->foreign('jobVacancy_id')->references('id')->on('job_vacancies')->onDelete('restrict');

            $table->uuid('resume_id');
            $table->foreign('resume_id')->references('id')->on('resumes')->onDelete('restrict');

            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
