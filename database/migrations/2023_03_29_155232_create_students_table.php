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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Parent_id')->default('0');
            $table->unsignedBigInteger('Class_id')->default('0');
            $table->unsignedBigInteger('Staff_id')->default('0');
            $table->string('FullName');
            $table->string('birthCertificateNO');
            $table->string('MyKid');
            $table->string('Address1');
            $table->string('Address2');
            $table->integer('Poscode');
            $table->string('City');
            $table->string('State');
            $table->date('DOB');
            $table->string('Sex');
            $table->string('PhoneNo');
            $table->string('Nationality');
            $table->string('Disability');
            $table->integer('BillSibling');
            $table->integer('AnakKe');
            $table->string('SchoolName');
            $table->string('Status');
            $table->string('ProfileImage') ->nullable();
            $table->string('LastPaymentDate') ->nullable();
            $table->string('RegistrastionFee') ->nullable();
            $table->string('ParentFullName');
            $table->string('ParentICno');
            $table->string('ParentAddress1');
            $table->string('ParentAddress2');
            $table->integer('ParentPoscode');
            $table->string('ParentCity');
            $table->string('ParentState');
            $table->string('ParentPhoneNo');
            $table->string('ParentNationality');
            $table->string('ParentJob');
            $table->float('ParentIncome');
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
        Schema::dropIfExists('students');
    }
};
