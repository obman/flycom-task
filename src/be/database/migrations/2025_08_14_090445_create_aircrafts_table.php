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
        Schema::create('aircrafts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('aircraft_types')->cascadeOnDelete();
            $table->foreignId('size_id')->constrained('aircraft_sizes')->cascadeOnDelete();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aircrafts');
    }
};
