<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Ouvrages;

class GenreController extends Controller
{

    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', compact('genres'));
    }


    public function create()
    {
        return view('genres.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
        ]);

        Genre::create([
            'libelle' => $request->input('libelle')
        ]);

        return redirect()->route('genres.index')->with('success', 'Genre créé avec succès.');
    }


    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('genres.edit', compact('genre'));
    }


    public function update($id, Request $request)
    {
        $genre = Genre::findOrFail($id);

        $request->validate([
            'libelle' => 'required|string|max:255',
        ]);

        $genre->update([
            'libelle' => $request->input('libelle')
        ]);

        return redirect()->route('genres.index')->with('success', 'Genre mis à jour avec succès.');
    }


    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return redirect()->route('genres.index')->with('success', 'Genre supprimé avec succès.');
    }
}
