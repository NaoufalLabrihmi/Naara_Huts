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
        Schema::create('hut_numbers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('huts_id');
            $table->unsignedBigInteger('hut_type_id');
            $table->string('hut_no')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->foreign('huts_id')->references('id')->on('huts')->onDelete('cascade');
            $table->foreign('hut_type_id')->references('id')->on('hut_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hut_numbers');
    }
};
