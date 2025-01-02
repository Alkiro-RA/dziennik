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
        Schema::create('teacher_subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Klucz obcy do tabeli użytkowników
            $table->unsignedBigInteger('subject_id'); // Klucz obcy do tabeli przedmiotów
            $table->timestamps();

            // Klucze obce i relacje
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');

            // Unikalne pary user_id + subject_id
            $table->unique(['user_id', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_subject');
    }
};
