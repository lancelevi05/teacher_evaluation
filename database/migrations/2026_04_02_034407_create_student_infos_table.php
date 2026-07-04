<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_infos', function (Blueprint $table) {
            $table->id();

            
            $table->string('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate(); // 👈 add this

            $table->string('usn');
            $table->foreign('usn')
                ->references('usn')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate(); // 👈 add this
            $table->string('idstrandcourse')->nullable();
          
            $table->string('yglevel')->nullable();
            $table->string('section')->nullable();
            $table->string('shs_college')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_infos');
    }
};
