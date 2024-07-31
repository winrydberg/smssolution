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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->decimal("amount")->nullable();
            $table->bigInteger("student_id")->nullable();
            $table->string("receipt_no")->nullable();
            $table->string("fee_name")->nullable();
            $table->string("academic_year")->nullable();
            $table->bigInteger("academic_year_id")->nullable();
            $table->date("paid_date")->nullable();
            $table->string("fee_id")->nullable();
            $table->bigInteger("term_id")->nullable(); // 
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
