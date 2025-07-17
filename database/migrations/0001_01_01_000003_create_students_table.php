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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date')->nullable();
            $table->boolean('looking_for_internship')->default(false);
            $table->text('description')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('phone_number')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->unique();
            $table->foreignId('experience_and_projects_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
