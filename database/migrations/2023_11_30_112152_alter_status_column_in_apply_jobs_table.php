<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE apply_jobs CHANGE status
        status ENUM('1', '2', '3', '4') COMMENT '1 - Application Sent, 2 - Resume Viewed, 3 - Shortlisted, 4 - Hired' NUll");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apply_jobs', function (Blueprint $table) {
            //
        });
    }
};
