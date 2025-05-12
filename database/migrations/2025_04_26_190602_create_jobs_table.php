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
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_title', 200)->nullable();
            $table->integer('employer_id')->unsigned()->nullable()->comment('foreign key (users)');
            $table->foreign('employer_id')->references('id')->on('users');
            $table->integer('designation_id')->unsigned()->nullable()->comment('foreign key (designations)');
            $table->foreign('designation_id')->references('id')->on('designations');
            $table->integer('job_category_id')->unsigned()->nullable()->comment('foreign key (job_categories)');
            $table->foreign('job_category_id')->references('id')->on('job_categories');
            $table->integer('job_type_id')->unsigned()->nullable()->comment('foreign key (job_types)');
            $table->foreign('job_type_id')->references('id')->on('job_types');
            $table->integer('work_type_id')->unsigned()->nullable()->comment('foreign key (work_types)');
            $table->foreign('work_type_id')->references('id')->on('work_types');
            $table->string('experience', 100)->nullable()->comment('In Years');
            $table->string('salary_range', 50)->nullable()->comment('In Lacs P.A');
            $table->text('job_description')->nullable();
            $table->text('job_responsibility')->nullable();
            $table->text('educational_requirements')->nullable();
            $table->text('other_benefits')->nullable();
            $table->string('vacancy', 5)->nullable();
            $table->text('skills')->nullable();
            $table->date('deadline')->nullable();
            $table->enum('gender', [1, 2, 3])->nullable()->comment('1 - Male, 2 - Female, 3 - Both');
            $table->enum('english_level', [1, 2, 3])->nullable()->comment('1 - Beginner, 2 - Intermediate, 3 - Advanced');
            $table->integer('country_id')->unsigned()->nullable()->comment('foreign key (countries)');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->integer('state_id')->unsigned()->nullable()->comment('foreign key (states)');
            $table->foreign('state_id')->references('id')->on('states');
            $table->integer('city_id')->unsigned()->nullable()->comment('foreign key (cities)');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->text('upload_file')->nullable();
            $table->enum('job_status', [1, 2, 3, 4])->default(1)->comment('1 - Pending, 2 - Approved, 3 - Hold, 4 - Rejected');
            $table->enum('status', [1, 2])->default(1)->comment('1 - Active, 2 - Inactive');
            $table->integer('created_by')->unsigned()->nullable()->comment('Auth/Login User');
            $table->integer('updated_by')->unsigned()->nullable()->comment('Auth/Login User');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['employer_id']);
            $table->index(['designation_id']);
            $table->index(['job_category_id']);
            $table->index(['job_type_id']);
            $table->index(['work_type_id']);
            $table->index(['country_id']);
            $table->index(['state_id']);
            $table->index(['city_id']);
            $table->index(['job_status']);
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
