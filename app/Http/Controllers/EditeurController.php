<?php

namespace App\Http\Controllers;

use App\Models\Editeur;
use Illuminate\Http\Request;

class EditeurController extends BaseController
{
    public function index()
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }
        $editeurs = Editeur::all();
        return view('editeurs.index', compact('editeurs'));
    }

    public function search(Request $request)
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }
        $search = $request->input('search');
        $editeurs = Editeur::where('libelle', 'like', '%' . $search . '%')->get();
        $html = '';

        foreach ($editeurs as $editeur) {
            $html .= '<tr>';
            $html .= '<td>' . $editeur->id_editeur . '</td>';
            $html .= '<td>' . $editeur->libelle . '</td>';
            $html .= '<td>';
            $html .= '<a href="' . route('editeurs.edit', $editeur->id_editeur) . '" class="btn btn-warning" style="margin-right: 5px;">Modifier</a>';
            $html .= '<form action="' . route('editeurs.destroy', $editeur->id_editeur) . '" method="POST" style="display: inline-block;">';
            $html .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
            $html .= '<input type="hidden" name="_method" value="DELETE">';
            $html .= '<button type="submit" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet éditeur ?\')" class="btn btn-danger">Supprimer</button>';
            $html .= '</form>';
            $html .= '</td>';
            $html .= '</tr>';
        }

        return $html;
    }

    public function create()
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }
        return view('editeurs.create');
    }

    public function store(Request $request)
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }
        $editeur = new Editeur();
        $editeur->id_editeur = $request->input('id_editeur');
        $editeur->libelle = $request->input('libelle');
        $editeur->save();
        return redirect()->route('editeurs.index');
    }

    public function edit($id_editeur)
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }
        $editeur = Editeur::find($id_editeur);
        return view('editeurs.edit', compact('editeur'));
    }

    public function update(Request $request, $id_editeur)
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }
        $editeur = Editeur::find($id_editeur);
        $editeur->libelle = $request->input('libelle');
        $editeur->save();
        return redirect()->route('editeurs.index');
    }

    public function destroy($id)
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }
        $editeur = Editeur::find($id);
        $editeur->delete();
        return redirect()->route('editeurs.index');
    }
}