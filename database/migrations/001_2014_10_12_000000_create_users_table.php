<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pres_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_number')->unique();
            $table->string('name');
            $table->integer('role')->default(1); 
            $table->string('password')->default(Hash::make('password2023'));
            $table->integer('first_time_login')->default(1);
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('pres_users');
    }
};