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
            $table->string("admission_no")->nullable();
            $table->string("index_no")->nullable();
            $table->longText("photo")->nullable();
            $table->string("student_id")->nullable();
            $table->string("first_name")->nullable();
            $table->string("middle_name")->nullable();
            $table->string("last_name")->nullable();
            $table->string("gender")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->bigInteger("school_id")->nullable();
            $table->bigInteger("class_id")->nullable();
            $table->bigInteger("sub_class_id")->nullable();
            $table->bigInteger("guardian_id")->nullable();
            $table->boolean("active")->nullable()->default(false);
            $table->bigInteger("student_status_id")->nullable();
            $table->softDeletes();
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
