<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Translations;
use App\Models\Books;
use Illuminate\View\View;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $translation = Translations::all();
        $books = Books::all();

        return view('books.translation', compact('translation', 'books'));
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

    public function store(Request $request, $id): JsonResponse
    {
        $validatedData = $request->validate([
            'translated_title' => 'required|max:255',
            'translated_description' => 'required',
            'translated_genre' => 'required',
            'translated_keywords' => 'nullable',
        ]);

        $translation = Translations::create([
            'book_id' => $id,
            'translated_title' => $validatedData['translated_title'],
            'translated_description' => $validatedData['translated_description'],
            'translated_genre' => $validatedData['translated_genre'],
            'translated_keywords' => $validatedData['translated_keywords'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Fordítás sikeresen hozzáadva!',
            'translation' => $translation
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $book = Books::findOrFail($id);
        $translation = Translations::where('book_id', $id)->first();
        $hasTranslation = !is_null($translation);
        return view('books.translation', compact('translation', 'book', 'hasTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Translations $translations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Translations $translations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Translations $translations)
    {
        //
    }
}
