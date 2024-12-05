<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'id_category',
        'id_author',
        'number_books',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function author(){
        return $this->belongsTo(Author::class, 'id_author');
    }
}
