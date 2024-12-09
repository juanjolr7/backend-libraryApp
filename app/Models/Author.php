<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors'; // Define explícitamente el nombre de la tabla

    protected $fillable = [
        'name',
        'nationality',
        'biography'
    ];

    public function books(){
        return $this->hasMany(Book::class, 'id_author');
    }
}
