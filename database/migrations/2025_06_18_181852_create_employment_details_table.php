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
        Schema::create('employment_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id')->unsigned()->nullable()->comment('foreign key (users)');
            $table->foreign('candidate_id')->references('id')->on('users');
            $table->integer('designation_id')->unsigned()->nullable()->comment('foreign key (designations)');
            $table->foreign('designation_id')->references('id')->on('designations');
            $table->string('organization', 255)->nullable();
            $table->string('work_from', 100)->nullable();
            $table->string('work_till', 100)->nullable();
            $table->string('experience', 100)->nullable()->comment('In Years');
            $table->enum('current_company', [1, 2])->default(2)->comment('1 - Yes, 2 - No');
            $table->text('job_profile')->nullable();
            $table->integer('created_by')->unsigned()->nullable()->comment('Auth/Login User');
            $table->integer('updated_by')->unsigned()->nullable()->comment('Auth/Login User');
            $table->timestamps();
            $table->index(['candidate_id']);
            $table->index(['designation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_details');
    }
};
