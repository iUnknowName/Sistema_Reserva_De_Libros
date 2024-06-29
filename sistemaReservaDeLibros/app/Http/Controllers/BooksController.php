<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category = $request->input('category');
    
        // Query para obtener los libros disponibles y opcionalmente filtrar por categoría
        $booksQuery = Books::where('reserved', false);
    
        if ($category) {
            $booksQuery->where('category', $category);
        }
    
        $books = $booksQuery->get();
    
        return view('books.index', compact('books', 'category'));
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
    public function show(Books $book)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Books $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Books $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Books $book)
    {
        //
    }

    /**
     * Maneja la reserva de un libro específico.
     */
    public function reserve(Books $book)
    {
        // Verifica si el libro ya está reservado
        if ($book->reserved) {
            return response()->json(['message' => 'El libro ya está reservado.'], 400);
        }

        // Realiza la reserva del libro
        $book->update(['reserved' => true]);

        return response()->json(['message' => '¡Libro reservado exitosamente!']);
    }
}
