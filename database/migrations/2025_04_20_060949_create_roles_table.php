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
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('created_by')->unsigned()->nullable()->comment('Auth/Login User');
            $table->integer('updated_by')->unsigned()->nullable()->comment('Auth/Login User');
            $table->enum('status', [1, 2])->default(1)->comment('1 - Active, 2 - Inactive');
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
        Schema::dropIfExists('roles');
    }
};
