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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'price' => 'required|numeric',
            'id_category' => 'required|exists:categories,id',
            'id_author' => 'required|exists:authors,id',
            'number_books' => 'required|integer|min:0',
        ]);

        $book = Book::create($request->all());
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
            'descripcion' => 'required|string',
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
