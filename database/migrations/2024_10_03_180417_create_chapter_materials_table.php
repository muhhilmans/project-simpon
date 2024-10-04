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
        Schema::create('chapter_materials', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->uuid('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects')->constrained()->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapter_materials');
    }
};
