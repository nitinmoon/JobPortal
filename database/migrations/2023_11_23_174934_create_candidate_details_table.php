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
            $table->text('address')->nullable();
            $table->integer('country_id')->unsigned()->nullable()->comment('foreign key (countries)');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->integer('state_id')->unsigned()->nullable()->comment('foreign key (states)');
            $table->foreign('state_id')->references('id')->on('states');
            $table->integer('city_id')->unsigned()->nullable()->comment('foreign key (cities)');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('zip', 10)->nullable();
            $table->text('resume_file')->nullable();
            $table->string('experience', 100)->nullable()->comment('In Years');
            $table->string('education', 100)->nullable();
            $table->text('skills')->nullable();
            $table->integer('created_by')->unsigned()->nullable()->comment('Auth/Login User');
            $table->integer('updated_by')->unsigned()->nullable()->comment('Auth/Login User');
            $table->timestamps();
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
