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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('User_ID');
            $table->string('ProfileImage') ->nullable();
            $table->string('FullName');
            $table->string('ICno');
            $table->string('Address1');
            $table->string('Address2');
            $table->integer('Poscode');
            $table->string('City');
            $table->string('State');
            $table->string('PhoneNo');
            $table->string('Nationality');
            $table->string('Position');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
