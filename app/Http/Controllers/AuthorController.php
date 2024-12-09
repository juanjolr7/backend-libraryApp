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
