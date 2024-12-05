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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->double('price');
            $table->unsignedBigInteger('id_category');

            $table->foreign('id_category')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('restrict');

            $table->unsignedBigInteger('id_author');

            $table->foreign('id_author')
                  ->references('id')
                  ->on('authors')
                  ->onDelete('restrict');

            $table->integer('number_books');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
