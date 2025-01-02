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
        Schema::create('subject_group', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id'); // Klucz obcy do tabeli przedmiotów
            $table->unsignedBigInteger('group_id'); // Klucz obcy do tabeli klas
            $table->timestamps();

            // Klucze obce i relacje
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');

            // Unikalne pary group_id + subject_id
            $table->unique(['group_id', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_group');
    }
};
