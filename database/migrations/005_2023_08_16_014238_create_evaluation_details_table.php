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
        Schema::create('pres_evaluation_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('evaluation_id');
            // $table->string('part_id')->nullable();
            $table->string('part_number')->nullable();
            $table->string('description')->nullable();
            $table->string('quantity')->nullable();
            $table->string('unit_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pres_evaluation_details');
    }
};
