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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nationality');
            $table->string('biography');
            $table->timestamps();
        });
        DB::table('authors')->insert([
            [
                'name' => 'Steven',
                'nationality' => 'Mexicano',
                'biography' => 'Escritor de SciFi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Oscar',
                'nationality' => 'Mexicano',
                'biography' => 'Escritor de Romance',
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
        Schema::dropIfExists('authors');
    }
};
