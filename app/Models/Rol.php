<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles'; // Define explícitamente el nombre de la tabla
    
    protected $fillable = [
        'name'
    ];

    public function users(){
        return $this->hasMany(User::class, 'id_rol');
    }
}
