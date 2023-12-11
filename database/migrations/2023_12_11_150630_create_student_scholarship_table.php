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
        Schema::create('student_scholarship', function (Blueprint $table) {
            $table->id();

            // Columns from the students table
            $table->foreignId('student_id')->unsigned()->constrained('students','student_osasid');

            // Columns from the scholarships table
            $table->foreignId('scholarship_id')->unsigned()->constrained('scholarships');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_scholarship');
    }
};
