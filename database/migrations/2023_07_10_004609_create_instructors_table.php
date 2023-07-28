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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->string('name' , 100);
            $table->string('email' , 100);
            $table->string('phone' , 11);
            $table->enum('gender' , ['male' , 'female'])->default('male');
            $table->double('salary');
            $table->enum('status' , ['under_review' , 'active'])->default('under_review');
            $table->foreignId('course_id')->constrained()->onDelete('cascade')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructors');
    }
};
