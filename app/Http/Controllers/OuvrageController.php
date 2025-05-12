<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Ouvrages;

class OuvrageController extends Controller
{
    public function index()
    {
        $ouvrages = Ouvrages::with(['editeur', 'genres', 'auteurs'])->get()->sortBy('titre');
        return view('ouvrages.ouvrage', compact('ouvrages'));
    }

    public function search(Request $request)
    {
        try {
            $titre = $request->query('titre');
            $editeur = $request->query('editeur');
            $genre = $request->query('genre');

            $query = Ouvrages::query();

            if ($titre) {
                $query->where('titre', 'like', "%$titre%");
            }

            if ($editeur) {
                $query->whereHas('editeur', function ($q) use ($editeur) {
                    $q->where('libelle', 'like', "%$editeur%");
                });
            }

            if ($genre) {
                $query->whereHas('genres', function ($q) use ($genre) {
                    $q->where('libelle', 'like', "%$genre%");
                });
            }

            $ouvrages = $query->with(['editeur', 'genres', 'auteurs'])->get();

            $html = '';
            if ($ouvrages->isEmpty()) {
                $html = '<tr><td colspan="6" style="text-align: center;">Aucun ouvrage trouvé.</td></tr>';
            } else {
                foreach ($ouvrages as $ouvrage) {
                    $html .= '<tr>';
                    $html .= '<td>' . htmlspecialchars($ouvrage->titre ?? 'N/A') . '</td>';
                    $html .= '<td>' . htmlspecialchars($ouvrage->code_isbn ?? 'N/A') . '</td>';
                    $html .= '<td>' . htmlspecialchars($ouvrage->editeur ? $ouvrage->editeur->libelle : 'Aucun éditeur') . '</td>';
                    $html .= '<td>' . htmlspecialchars(ucfirst($ouvrage->type)) . '</td>';
                    $html .= '<td>';
                    $auteurs = $ouvrage->auteurs ? $ouvrage->auteurs->map(fn($auteur) => trim(preg_replace('/\s+/', ' ', $auteur->nom . ' ' . $auteur->prenom)))->toArray() : [];
                    $html .= htmlspecialchars(!empty($auteurs) ? implode(', ', $auteurs) : 'Aucun auteur');
                    $html .= '</td>';
                    $html .= '<td>';
                    $genres = $ouvrage->genres ? $ouvrage->genres->pluck('libelle')->toArray() : [];
                    $html .= htmlspecialchars(!empty($genres) ? implode(', ', $genres) : 'Aucun genre');
                    $html .= '</td>';
                    $html .= '<td>';
                    $html .= '<div style="display: flex; gap: 8px; justify-content: center; align-items: center;">';
                    $html .= '<a href="' . route('ouvrages.edit', $ouvrage->id_ouvrage) . '" class="btn btn-warning btn-sm">Modifier</a>';
                    $html .= '<form class="form" action="' . route('ouvrages.destroy', $ouvrage->id_ouvrage) . '" method="POST" style="display:inline;">';
                    $html .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                    $html .= '<input type="hidden" name="_method" value="DELETE">';
                    $html .= '<button type="submit" class="btn btn-danger btn-sm">Supprimer</button>';
                    $html .= '</form>';
                    $html .= '</div>';
                    $html .= '</td>';
                    $html .= '</tr>';
                }
            }

            return $html;
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue lors de la recherche.',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    public function creer()
    {
        $genres = Genre::all();
        $editeurs = \App\Models\Editeur::all();
        $auteurs = \App\Models\Auteur::all();
        return view('ouvrages.OuvrageCreation', compact('genres', 'editeurs', 'auteurs'));
    }

    public function creation(Request $request)
    {
        $request->validate([
            'id_editeur' => 'required|integer|exists:editeurs,id_editeur',
            'code_isbn' => 'nullable|string|unique:ouvrages,code_isbn',
            'titre' => 'required|string|max:255',
            'type' => 'required|in:livre,magazine,ebook',
            'genres' => 'nullable|array',
            'genres.*' => 'exists:genres,id_genre',
            'auteurs' => 'required|array',
            'auteurs.*' => 'exists:auteurs,id_auteur',
        ]);

        try {
            $ouvrage = Ouvrages::create([
                'id_editeur' => $request->input('id_editeur'),
                'code_isbn' => $request->input('code_isbn'),
                'titre' => $request->input('titre'),
                'type' => $request->input('type'),
            ]);

            if ($request->has('genres')) {
                $ouvrage->genres()->sync($request->input('genres'));
            }

            if ($request->has('auteurs')) {
                $ouvrage->auteurs()->sync($request->input('auteurs'));
            }

            return redirect()->route('ouvrages')->with('success', 'Ouvrage ajouté avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de la création de l\'ouvrage : ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id_ouvrage)
    {
        $ouvrage = Ouvrages::with(['genres', 'auteurs'])->findOrFail($id_ouvrage);
        $genres = Genre::all();
        $editeurs = \App\Models\Editeur::all();
        $auteurs = \App\Models\Auteur::all();
        return view('ouvrages.OuvrageModifier', compact('ouvrage', 'genres', 'editeurs', 'auteurs'));
    }

    public function update($id_ouvrage, Request $request)
    {
        $request->validate([
            'id_editeur' => 'required|integer|exists:editeurs,id_editeur',
            'code_isbn' => 'nullable|string|unique:ouvrages,code_isbn,' . $id_ouvrage . ',id_ouvrage',
            'titre' => 'required|string|max:255',
            'type' => 'required|in:livre,magazine,ebook',
            'genres' => 'nullable|array',
            'genres.*' => 'exists:genres,id_genre',
            'auteurs' => 'required|array',
            'auteurs.*' => 'exists:auteurs,id_auteur',
        ]);

        $ouvrage = Ouvrages::findOrFail($id_ouvrage);
        $ouvrage->update([
            'id_editeur' => $request->input('id_editeur'),
            'code_isbn' => $request->input('code_isbn'),
            'titre' => $request->input('titre'),
            'type' => $request->input('type'),
        ]);

        if ($request->has('genres')) {
            $ouvrage->genres()->sync($request->input('genres'));
        }

        if ($request->has('auteurs')) {
            $ouvrage->auteurs()->sync($request->input('auteurs'));
        }

        return redirect()->route('ouvrages')->with('success', 'Ouvrage mis à jour avec succès.');
    }

    public function destroy($id_ouvrage)
    {
        $ouvrage = Ouvrages::findOrFail($id_ouvrage);
        $ouvrage->delete();
        return redirect()->route('ouvrages');
    }
}