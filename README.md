![image](https://github.com/user-attachments/assets/2418839e-c65a-4669-bd39-81e3b5b22f44)<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Proyecto final "Librería Virtual"

## Objetivo del proyecto
El propósito de este repositorio del proyecto final es desarrollar el backend con Laravel, de aplicación en cuyo frontend fue desarrollado con Angular. Todos los datos utilizada en el programa, son obtenidas por una API generada del lado del backend, con Laravel. Laravel y MySQL se encargan construir el backend y la base de datos respectivamente.

## Requisitos Previos
#### Conocimientos básicos en Laravel y MySQL.
#### Tener instalado MySQL Workbench.
#### Conexión a API generada desde Laravel

## Parte 1: Configuración del .env

El archivo .env en Laravel es una pieza central para configurar tu aplicación. Contiene variables de entorno que influyen en el comportamiento y la configuración de la aplicación. En este archivo se puede configurar el modo de ejecución, la conexión a la base de datos y la conexión con el servidor de correo electrónico. Los valores de configuración se recuperan desde varios archivos de configuración de Laravel dentro del directorio config utilizando la función env de Laravel. A continuación, para tener conexión a la base de datos en MySQL Workbench configuraremos el archivo de la siguiente manera:

```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:UIKnU2Dt+0ehw9iXXLL0eJENrQktlZIG0gz1Mua6ays=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=angular_laravel
DB_USERNAME=root
DB_PASSWORD=admin

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

## Parte 2: Creación de migraciones

```bash
php artisan make:migration NombreTabla
```
#### categories

```bash
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
```

#### authors

```bash
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

```
#### books
```bash
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
```
#### roles
```bash
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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('roles')->insert([
            [
                'name' => 'Administrador',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cliente',
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
        Schema::dropIfExists('roles');
    }
};
```
#### users
```bash
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
```

#### personal
```bash
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
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
```

## Parte 3: Creación de modelos
Los modelos representan las tablas en la base de datos, utilizadas para interactuar y realizar operaciones como insertar, actualizar y eliminar datos. A continuación, se muestran los códigos de los modelos:

#### Comando para crear los modelos
```bash
php artisan make:model NombreDelModelo
```

#### Author
```bash
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
```
#### Book
```bash
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
```
#### Category
```bash
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function books(){
        return $this->hasMany(Book::class, 'id_category');
    }
}
```
#### Rol
```bash
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
```
#### User
```bash
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_rol'
    ];

    public function rol(){
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
}
```

## Parte 3: Creación de controladores
Un controlador es un componente que recibe las solicitudes, procesa la lógica de negocio correspondiente y devuelve una respuesta adecuada. Actúa como intermediario entre las rutas y las vistas, manejando la lógica de las acciones que se deben realizar.
 
#### Comando para crear los controladores
```bash
php artisan make:controller nombreControlador
```
#### UserControler
```bash
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtiene todos los usuarios junto con sus roles
        $users = User::with('rol')->get();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'id_rol' => 2,
            'created_at' => now()
        ]);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado.'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6' // Si la contraseña no se actualiza, debe ser opcional
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'updated_at' => now()
        ]);

        return response()->json(['message' => 'Usuario actualizado con éxito.', 'user' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User no found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted succesfully']);
    }
}
```
#### AuthorController
```bash
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtiene todos los usuarios junto con sus roles
        $author = Author::all();
        return response()->json($author);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'required|string|max:30',
            'biography' => 'required|string|max:255'
        ]);

        $author = Author::create([
            'name' => $validated['name'],
            'nationality' => $validated['nationality'],
            'biography' => $validated['biography'],
            'created_at' => now()
        ]);

        return response()->json($author, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['message' => 'Autor no encontrado.'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'required|string|max:30',
            'biography' => 'required|string|max:255'
        ]);

        $author->update([
            'name' => $validated['name'],
            'nationality' => $validated['nationality'],
            'biography' => $validated['biography'],
            'updated_at' => now()
        ]);

        return response()->json(['message' => 'Autor actualizado con éxito.', 'autor' => $author], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['message' => 'Author no found'], 404);
        }

        $author->delete();
        return response()->json(['message' => 'Author deleted succesfully']);
    }
}
```
#### BookController
```bash
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('category', 'author')->get();
        return response()->json($books);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //para api no se usa   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'id_category' => 'required|exists:categories,id',
            'id_author' => 'required|exists:authors,id',
            'number_books' => 'required|integer|min:0',
        ]);

        $book = Book::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'id_category' => $validated['id_category'],
            'id_author' => $validated['id_author'],
            'number_books' => $validated['number_books'],
            'created_at' => now()
        ]);

        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with('category', 'author')->find($id);
        if(!$book){
            return response()->json(['message' => 'Book no found'], 404);
        }
        return response()->json($book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);

        if(!$book){
            return response()->json(['message' => 'Book not found'], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'id_category' => 'required|exists:categories,id',
            'id_author' => 'required|exists:authors,id',
            'number_books' => 'required|integer|min:0',
        ]);

        $book->update($request->all());
        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        if(!$book){
            return response()->json(['message' => 'Book no found'], 404);
        }

        $book->delete();
        return response()->json(['message'=>'Book deleted succesfully']);
    }
}
```
#### CategoryController
```bash
<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
```

#### RolController
```bash
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Rol::all();
        return response()->json($roles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
```

#### Creación del archivo api.php
Este archivo define las interfaces de las rutas que aceptará nuestra aplicación, por defecto viene web y api. 

```bash
php artisan install:api
```

```bash
<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RolController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use PharIo\Manifest\AuthorCollection;

Route::apiResource('users', UserController::class);
Route::apiResource('authors', AuthorController::class);
Route::apiResource('books', BookController::class);
Route::apiResource('roles', RolController::class);
Route::apiResource('categories', CategoryController::class);
```
