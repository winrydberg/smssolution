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
        Schema::create('academic_records', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("academic_record_type_id")->nullable();
            $table->float("mark")->nullable();
            $table->bigInteger("student_id")->nullable();
            $table->string("index_no")->nullable();
            $table->bigInteger("staff_id")->nullable(); // teacher id
            $table->bigInteger("subject_id")->nullable(); // subject id
            $table->bigInteger("class_id")->nullable(); // subject id
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_records');
    }
};
