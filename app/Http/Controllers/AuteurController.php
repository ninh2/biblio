<?php

namespace App\Http\Controllers;

use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurController extends BaseController
{
    public function index()
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }
        $auteurs = Auteur::all()->sortBy('nom')->sortBy('prenom');
        return view('auteurs.index', compact('auteurs'));
    }

    public function create()
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }
        return view('auteurs.create');
    }

    public function store(Request $request)
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
        ]);

        Auteur::create($request->all());

        return redirect()->route('auteurs.index');
    }

    public function edit(Auteur $auteur)
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }
        return view('auteurs.edit', compact('auteur'));
    }

    public function update(Request $request, Auteur $auteur)
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
        ]);

        $auteur->update($request->all());

        return redirect()->route('auteurs.index');
    }

    public function destroy(Auteur $auteur)
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }
        $auteur->delete();
        return redirect()->route('auteurs.index');
    }
}