<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Ouvrages;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    // Afficher tous les commentaires
    public function index()
    {
        $commentaires = Commentaire::all();  // Récupère tous les commentaires
        return view('/commentaire.index', compact('commentaires'));
    }

    // Afficher le formulaire de création d'un commentaire
    public function create()
    {
        $ouvrages = Ouvrages::all();  // Liste des ouvrages pour le formulaire
        return view('commentaire.create', compact('ouvrages'));
    }

    // Enregistrer un nouveau commentaire
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'id_ouvrage' => 'required|exists:ouvrages,id_ouvrage',
            'statut' => 'required|string',
            'note' => 'required|integer|min:1|max:5',
        ]);

        // Création du commentaire
        Commentaire::create($validated);

        // Redirection avec un message flash
        return redirect('/commentaires')->with('success', 'Commentaire ajouté avec succès.');
    }

    // Afficher le formulaire de modification d'un commentaire
    public function edit($id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $ouvrages = Ouvrages::all();
        return view('commentaire.edit', compact('commentaire', 'ouvrages'));
    }

    // Mettre à jour un commentaire
    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'id_ouvrage' => 'required|exists:ouvrages,id_ouvrage',
            'statut' => 'required|string',
            'note' => 'required|integer|min:1|max:5',
        ]);

        // Trouver le commentaire et le mettre à jour
        $commentaire = Commentaire::findOrFail($id);
        $commentaire->update($validated);

        // Redirection avec un message flash
         return redirect('/commentaires')->with('success', 'Commentaire mis à jour avec succès.');
    }

    // Supprimer un commentaire
    public function destroy($id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $commentaire->delete();

        // Redirection avec un message flash
        return redirect('/commentaires')->with('success', 'Commentaire supprimé avec succès.');
    }
}
