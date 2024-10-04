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
        Schema::create('classroom_users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('classroom_id');
            $table->uuid('user_id');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->constrained()->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_users');
    }
};
