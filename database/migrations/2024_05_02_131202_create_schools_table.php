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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string("logo")->nullable();
            $table->string("name")->nullable();
            $table->longText("description")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->string("owner_name")->nullable();
            $table->string("user_id")->nullable();
            $table->bigInteger("total_students")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
