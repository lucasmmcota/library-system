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
        Schema::create('loan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_member');
            $table->unsignedBigInteger('id_book_copies');
            $table->unsignedBigInteger('id_loan_term');
            $table->integer('number_renovations')->default(0);
            $table->dateTime('loan_date');
            $table->dateTime('devolution_date');
            $table->dateTime('return_date')->nullable();
            $table->tinyInteger('returned')->default(0);
            $table->timestamps();

            $table->foreign('id_member')->references('id')->on('member');
            $table->foreign('id_book_copies')->references('id')->on('book_copies');
            $table->foreign('id_loan_term')->references('id')->on('loan_term');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan');
    }
};
