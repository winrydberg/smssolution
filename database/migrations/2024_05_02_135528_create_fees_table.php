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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->decimal("amount")->nullable();
            $table->boolean("active")->nullable();
            $table->bigInteger("user_id")->nullable();
            $table->string("model")->nullable(); // the model the fees applies on. Null for the whole school
            $table->string("applies_on")->nullable();
            $table->bigInteger("term_id")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
