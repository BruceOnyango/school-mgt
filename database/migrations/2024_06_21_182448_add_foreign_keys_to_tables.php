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
        Schema::table('tables', function (Blueprint $table) {
            
            // Adding foreign keys to students table
        Schema::table('students', function (Blueprint $table) {
            $table->foreignId('class_id')->constrained('classrooms')->cascadeOnDelete();
              // $table->foreignId('class_id')->constrained('classrooms')->cascadeOnDelete();
        });

        // Adding foreign keys to teachers table
        Schema::table('teachers', function (Blueprint $table) {
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
             //  $table->foreignId('subject_id')->nullable()->constrained('subjects')->cascadeOnDelete();
        });

        // Adding foreign keys to subjects table
        Schema::table('subjects', function (Blueprint $table) {
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
              // $table->foreignId('teacher_id')->nullable()->constrained('teachers')->cascadeOnDelete();
        });

        // Adding foreign keys to other tables as needed
        Schema::table('classrooms', function (Blueprint $table) {
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->cascadeOnDelete();
            // $table->foreignId('teacher_id')->nullable()->constrained('teachers')->cascadeOnDelete();
        });

        // Adding foreign keys to enrollments table
        Schema::table('enrollments', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('classroom_id')->constrained('classrooms')->cascadeOnDelete();

             //  $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
          //  $table->foreignId('classroom_id')->constrained('classrooms')->cascadeOnDelete();
        });

        // Adding foreign keys to grades table
        Schema::table('grades', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();

              //  $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            //$table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
        });

        // Adding foreign keys to attendances table
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
         

             //  $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
        });

        // Adding foreign keys to events table
       Schema::table('events', function (Blueprint $table) {
            $table->foreignId('classroom_id')->constrained('classrooms')->cascadeOnDelete();
        });

        // Adding foreign keys to assignments table
        Schema::table('assignments', function (Blueprint $table) {
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('classroom_id')->constrained('classrooms')->cascadeOnDelete();

                //  $table->foreignId('classroom_id')->constrained('classrooms')->cascadeOnDelete();
          //  $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
        });

         // Adding foreign keys to library_transactions table
         Schema::table('library_transactions', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('book_id')->constrained('library_books')->cascadeOnDelete();
        });

        // Adding foreign keys to notices table
        Schema::table('notices', function (Blueprint $table) {
            $table->foreignId('posted_by')->constrained('teachers')->cascadeOnDelete();
        });

        // Adding foreign keys to payments table
        Schema::table('payments', function (Blueprint $table) {
          
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
        });

        // Adding foreign keys to fees table
        Schema::table('fees', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            
        });

        // Adding foreign keys to exam_results table
        Schema::table('exam_results', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('exam_id')->constrained('exams')->cascadeOnDelete();
           
        });

        // Adding foreign keys to exams table
        Schema::table('exams', function (Blueprint $table) {
          
            $table->foreignId('classroom_id')->constrained('classrooms')->cascadeOnDelete();
        });

        // Adding foreign keys to timetables table
        Schema::table('timetables', function (Blueprint $table) {
            $table->foreignId('classroom_id')->constrained('classrooms')->cascadeOnDelete();
         
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();

            
          //  $table->foreignId('classroom_id')->constrained('classrooms')->cascadeOnDelete();
          //  $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
        });

      
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            // Dropping foreign keys from students table
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['class_id']);
        });

        // Dropping foreign keys from teachers table
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropForeign(['subject_id']);
        });

        // Dropping foreign keys from subjects table
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
        });

        // Dropping foreign keys from classrooms table
        Schema::table('classrooms', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
        });

        // Dropping foreign keys from enrollments table
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['classroom_id']);
        });

        // Dropping foreign keys from grades table
        Schema::table('grades', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['subject_id']);
        });

        // Dropping foreign keys from attendances table
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
        });

        // Dropping foreign keys from events table
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['classroom_id']);
        });

        // Dropping foreign keys from assignments table
        Schema::table('assignments', function (Blueprint $table) {
            $table->dropForeign(['subject_id']);
            $table->dropForeign(['classroom_id']);
        });

        // Dropping foreign keys from library_transactions table
        Schema::table('library_transactions', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['book_id']);
        });

        // Dropping foreign keys from notices table
        Schema::table('notices', function (Blueprint $table) {
            $table->dropForeign(['posted_by']);
        });

        // Dropping foreign keys from payments table
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
        });

        // Dropping foreign keys from fees table
        Schema::table('fees', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
        });

        // Dropping foreign keys from exam_results table
        Schema::table('exam_results', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['exam_id']);
        });

        // Dropping foreign keys from exams table
        Schema::table('exams', function (Blueprint $table) {
            $table->dropForeign(['classroom_id']);
        });

        // Dropping foreign keys from timetables table
        Schema::table('timetables', function (Blueprint $table) {
            $table->dropForeign(['classroom_id']);
            $table->dropForeign(['subject_id']);
        });
        });
    }
};
