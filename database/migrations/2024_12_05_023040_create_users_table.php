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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('id_rol');
            
            $table->foreign('id_rol')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('restrict');
                  
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'name' => 'Juan José López Rosado',
                'email' => 'admin@gmail.com',
                'password' => 'admin123',
                'id_rol' => 1,
                'created_at' => now()
            ],
            [
                'name' => 'Franco Steve Sosa',
                'email' => 'cliente@gmail.com',
                'password' => 'cliente123',
                'id_rol' => 2,
                'created_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
