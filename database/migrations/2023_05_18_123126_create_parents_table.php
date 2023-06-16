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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('User_ID')->default('1');
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
            $table->string('Job');
            $table->float('Income');
            $table->string('OfficeAddress1');
            $table->string('OfficeAddress2');
            $table->integer('OfficePoscode');
            $table->string('OfficeCity');
            $table->string('OfficeState');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};
