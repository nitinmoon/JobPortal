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
        Schema::create('education_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id')->unsigned()->nullable()->comment('foreign key (users)');
            $table->foreign('candidate_id')->references('id')->on('users');
            $table->string('education', 255)->nullable();
            $table->string('college', 255)->nullable();
            $table->string('university', 255)->nullable();
            $table->string('year_of_passing', 100)->nullable();
            $table->decimal('percentage', 10, 2)->nullable();
            $table->integer('created_by')->unsigned()->nullable()->comment('Auth/Login User');
            $table->integer('updated_by')->unsigned()->nullable()->comment('Auth/Login User');
            $table->timestamps();
            $table->index(['candidate_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_details');
    }
};
