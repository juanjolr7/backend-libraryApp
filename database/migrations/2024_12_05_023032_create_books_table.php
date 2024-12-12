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
        DB::table('books')->insert([
            [
                'title' => 'TituloX',
                'description' => 'admsda',
                'price' => 22.2,
                'id_category' => 1,
                'id_author' => 1,
                'number_books'=>4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'TituloY',
                'description' => 'jghjty',
                'price' => 55.99,
                'id_category' => 2,
                'id_author' => 2,
                'number_books'=>10,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
