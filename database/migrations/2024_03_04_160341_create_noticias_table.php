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
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id')->nullable(); // Add this line for the foreign key
            $table->string('slug')->unique()->nullable();
            $table->string('titulo');
            $table->string('subtitulo');
            $table->longText('corpo');
            $table->string('imagem')->nullable();
            $table->string('legenda_imagem')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};
