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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('title', [1, 2, 3, 4])->nullable()->comment('1 - Mr, 2 - Mrs, 3 - Miss, 4 - Other');
            $table->string('first_name', 100)->nullable();
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('email', 100);
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('verify_otp', 10)->nullable();
            $table->string('phone', 15)->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['M', 'F', 'T', 'O'])->default('M')->comment('M - Male, F - Female, T - Transgender, O - Others');
            $table->date('date_of_joining')->nullable();
            $table->date('date_of_exit')->nullable();
            $table->string('profile_photo', 10)->nullable();
            $table->enum('portal_access', [0, 1])->default(1)->comment('0 - No Login , 1 - Login Granted');
            $table->enum('status', [1, 2])->default(1)->comment('1 - Approved, 2 - Disapproved');
            $table->integer('role_id')->unsigned()->nullable()->comment('foreign key (roles)');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->dateTime('last_login')->nullable();
            $table->integer('created_by')->unsigned()->nullable()->comment('Auth/Login User');
            $table->integer('updated_by')->unsigned()->nullable()->comment('Auth/Login User');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['status']);
            $table->index(['role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
