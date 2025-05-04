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
        Schema::create('candidate_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id')->unsigned()->nullable()->comment('foreign key (users)');
            $table->foreign('candidate_id')->references('id')->on('users');
            $table->integer('designation_id')->unsigned()->nullable()->comment('foreign key (designations)');
            $table->foreign('designation_id')->references('id')->on('designations');
            $table->string('current_salary', 100)->nullable()->comment('In Lacs P.A');
            $table->string('expected_salary', 100)->nullable()->comment('In Lacs P.A');
            $table->string('experience', 100)->nullable()->comment('In Years');
            $table->enum('marital_status', [1, 2, 3, 4, 5])->nullable()->comment('1 - Single, 2 - Married, 3 - Divorced, 4 - Widowed, 5 - Separated');
            $table->string('education', 100)->nullable();
            $table->text('skills')->nullable();
            $table->text('resume_headline')->nullable();
            $table->text('description')->nullable();
            $table->text('profile_summary')->nullable();
            $table->text('languages')->nullable();
            $table->text('resume_file')->nullable();
            $table->enum('availability_to_join', [1, 2, 3, 4])->nullable()->comment('1 - 15 Days, 2 - 1 Months, 3 - 2 Months, 4 - 3 Months');
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
        Schema::dropIfExists('candidate_details');
    }
};
