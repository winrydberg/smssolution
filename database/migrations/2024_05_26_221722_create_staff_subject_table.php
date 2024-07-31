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
        Schema::create('staff_subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("staff_id")->nullable();
            $table->unsignedBigInteger("subject_id")->nullable();
            $table->unsignedBigInteger("class_id")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_subject');
    }
};
