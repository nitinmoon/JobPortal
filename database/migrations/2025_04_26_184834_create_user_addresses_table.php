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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->text('address')->nullable();
            $table->integer('country_id')->unsigned()->nullable()->comment('foreign key (countries)');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->integer('state_id')->unsigned()->nullable()->comment('foreign key (states)');
            $table->foreign('state_id')->references('id')->on('states');
            $table->integer('city_id')->unsigned()->nullable()->comment('foreign key (cities)');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->integer('user_id')->unsigned()->nullable()->comment('foreign key (users)');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['country_id']);
            $table->index(['state_id']);
            $table->index(['city_id']);
            $table->index(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
