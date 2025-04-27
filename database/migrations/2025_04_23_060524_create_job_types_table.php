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
        Schema::create('job_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->enum('status', [1, 2])->default(2)->comment('1 - Inactive, 2 - Active');
            $table->integer('created_by')->unsigned()->nullable()->comment('Auth/Login User');
            $table->integer('updated_by')->unsigned()->nullable()->comment('Auth/Login User');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_types');
    }
};
