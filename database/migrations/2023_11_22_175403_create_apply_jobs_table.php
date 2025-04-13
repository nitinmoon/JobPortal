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
        Schema::create('apply_jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('job_id')->unsigned()->nullable()->comment('foreign key (jobs)');
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->integer('candidate_id')->unsigned()->nullable()->comment('foreign key (users)');
            $table->foreign('candidate_id')->references('id')->on('users');
            $table->integer('employer_id')->unsigned()->nullable()->comment('foreign key (users)');
            $table->foreign('employer_id')->references('id')->on('users');
            $table->enum('status', [1, 2, 3])->default(1)->comment('1 - Application Sent, 2 - Resume Viewed, 3 - Shortlisted');
            $table->index(['job_id']);
            $table->index(['candidate_id']);
            $table->index(['employer_id']);
            $table->index(['status']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apply_jobs');
    }
};
