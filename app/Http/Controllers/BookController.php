<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Books::all();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'author' => 'required|string|max:255',
            'genre' => 'nullable|string|max:255',
            'release_date' => 'nullable|date',
            'keywords' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book = Books::create($validated);
        $book->cover_image = $book->cover_image ? asset('storage/' . $book->cover_image) : null;

        return response()->json([
            'success' => true,
            'message' => 'Könyv sikeresen hozzáadva!',
            'book' => $book,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Books $books)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Books $book)
    {
        return response()->json([
            'success' => true,
            'book' => $book,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Books $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'release_date' => 'required|date',
            'keywords' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update($validated);

        if ($book->cover_image) {
            $book->cover_image = asset('storage/' . $book->cover_image);
        }

        return response()->json([
            'success' => true,
            'message' => 'Könyv sikeresen frissítve!',
            'book' => $book,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Books $book)
    {
        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Könyv sikeresen törölve!',
        ]);   
    }
}
