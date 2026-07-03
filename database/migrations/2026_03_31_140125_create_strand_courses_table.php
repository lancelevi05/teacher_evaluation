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
        Schema::create('strand_courses', function (Blueprint $table) {
            $table->id();
            $table->string('idstrandcourse');
            $table->string('strandcourse');
            $table->string('max_section');
            $table->string('shs_college');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strand_courses');
    }
};
