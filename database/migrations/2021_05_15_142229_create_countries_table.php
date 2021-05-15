<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            // ID
            $table->id();

            // Relations
            // ...

            // Data
            $table->string('name');
            $table->string('flag');
            $table->string('song_title');
            $table->string('artist');

            $table->boolean('currently_voting')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
}
