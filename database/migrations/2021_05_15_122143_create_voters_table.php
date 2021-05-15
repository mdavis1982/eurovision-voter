<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotersTable extends Migration
{
    public function up(): void
    {
        Schema::create('voters', function (Blueprint $table) {
            // ID
            $table->id();

            // Relations
            // ...

            // Data
            $table->string('name');
            $table->string('number');

            $table->timestamp('confirmed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voters');
    }
}
