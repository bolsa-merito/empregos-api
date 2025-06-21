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
        Schema::create('studyings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('students_id')->constrained()->onDelete('cascade');
            $table->foreignId('courses_id')->constrained()->onDelete('cascade');
            $table->foreignId('institutions_id')->constrained()->onDelete('cascade');
            $table->date('beginning')->nullable();
            $table->date('end')->nullable();
            $table->string('semester');
            $table->string('period');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studyings');
    }
};
