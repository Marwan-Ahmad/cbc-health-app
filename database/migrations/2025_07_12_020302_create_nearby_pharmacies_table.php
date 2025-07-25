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
        Schema::create('nearby_pharmacies', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("pharmacist_name")->nullable();
            $table->string("phone")->unique();
            $table->string("location")->nullable();
            $table->string("working_hours")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nearby_pharmacies');
    }
};