<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            // ID
            $table->id();

            // Relations
            $table->foreignId('voter_id')->constrained('voters')->cascadeOnDelete();
            $table->foreignId('country_id')->constrained('countries')->cascadeOnDelete();

            // Data
            $table->integer('value');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
}
