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
        Schema::create('employer_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employer_id')->unsigned()->nullable()->comment('foreign key (users)');
            $table->foreign('employer_id')->references('id')->on('users');
            $table->string('company_name', 200)->nullable();
            $table->text('company_logo')->nullable();
            $table->text('company_description')->nullable();
            $table->string('company_contact_person', 100)->nullable();
            $table->string('company_contact_email', 100)->nullable();
            $table->string('company_contact_no', 15)->nullable();
            $table->date('foundation_date')->nullable();
            $table->string('no_of_employees', 50)->nullable();
            $table->string('gst_no', 20)->nullable();
            $table->text('company_address')->nullable();
            $table->integer('country_id')->unsigned()->nullable()->comment('foreign key (countries)');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->integer('state_id')->unsigned()->nullable()->comment('foreign key (states)');
            $table->foreign('state_id')->references('id')->on('states');
            $table->integer('city_id')->unsigned()->nullable()->comment('foreign key (cities)');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('zip', 10)->nullable();
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
        Schema::dropIfExists('employer_details');
    }
};
