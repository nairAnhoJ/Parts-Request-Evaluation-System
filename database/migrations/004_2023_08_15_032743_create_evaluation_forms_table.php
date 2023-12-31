<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pres_evaluation_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->string('control_number');
            $table->unsignedBigInteger('customer_id');
            $table->string('fsrr_number');
            $table->string('brand');
            $table->string('model');
            $table->string('serial_number');
            $table->string('hm')->nullable();
            $table->string('technician');
            $table->string('working_environment');
            $table->string('status');
            $table->string('disc')->nullable();
            $table->string('remarks')->nullable();

            $table->string('originator')->nullable();
            $table->string('datetime_originated')->nullable();

            $table->boolean('is_validated')->default(0);
            $table->string('validator')->nullable();
            $table->string('datetime_validated')->nullable();

            $table->string('sq_number')->nullable();
            $table->string('encoder')->nullable();
            $table->string('datetime_encoded')->nullable();

            $table->boolean('is_approved')->default(0);
            $table->string('approver')->nullable();
            $table->string('datetime_approved')->nullable();

            $table->string('date_received');
            $table->boolean('is_deleted')->default(0);
            $table->string('key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pres_evaluation_forms');
    }
};
