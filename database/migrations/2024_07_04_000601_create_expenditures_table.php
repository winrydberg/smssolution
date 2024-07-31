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
        Schema::create('expenditures', function (Blueprint $table) {
            $table->id();
            $table->longText("description")->nullable();
            $table->decimal("amount")->default(0.0);
            $table->bigInteger("expenditure_category_id")->nullable();
            $table->date("date_spent")->nullable();
            $table->bigInteger("term_id")->nullable();
            $table->string("academic_year")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenditures');
    }
};
