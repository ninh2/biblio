<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends BaseController
{
    public function Inscription()
    {
        return view('createUser');
    }

    public function CreateUser(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email',
            'dateDeNaissance' => 'required|date',
            'password' => 'required|string',
            'adresse' => 'required|string',
            'cp' => 'required|string',
            'ville' => 'required|string',
            'news' => 'nullable|integer',
        ]);

        $utilisateur = User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'date_naissance' => $validated['dateDeNaissance'],
            'mot_de_passe' => Hash::make($validated['password']),
            'adresse' => $validated['adresse'],
            'code_postal' => $validated['cp'],
            'ville' => $validated['ville'],
            'reception_newsletter' => $validated['news'],
        ]);
        return view('loginUser');
    }

    public function Connexion()
    {
        return view('loginUser');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if ($user && Hash::check($validated['password'], $user->mot_de_passe)) {
            $UserSession = [
                'nom' => $user->nom,
                'prenom' => $user->prenom,
                'statut' => $user->statut,
                'role' => $user->role,
            ];
            Session::put('user', $UserSession);
            return redirect('/');
        }
        return back()->withErrors(['email' => 'Identifiants invalides.']);
    }

    public function logout()
    {
        Session::flush();
        return redirect('/Connexion');
    }

    public function ListeUsers()
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }
        $users = User::all();
        return view('listeUsers', compact('users'));
    }

    public function supprimer($id_utilisateur)
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }
        $utilisateur = User::where('id_utilisateur', $id_utilisateur)->first();
        if ($utilisateur) {
            $utilisateur->delete();
        }
        return redirect()->route('users.list')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function edit($id_utilisateur)
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }
        $utilisateur = User::where('id_utilisateur', $id_utilisateur)->first();
        if (!$utilisateur) {
            return redirect()->route('users.list')->withErrors('Utilisateur non trouvé');
        }
        return view('edit', compact('utilisateur'));
    }

    public function update(Request $request, $id_utilisateur)
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }
        $request->validate([
            'role' => 'required|string|max:255',
            'statut' => 'required|string|max:255',
        ]);

        $utilisateur = User::where('id_utilisateur', $id_utilisateur)->first();
        if (!$utilisateur) {
            return redirect()->route('users.list')->withErrors('Utilisateur non trouvé');
        }

        $utilisateur->role = $request->input('role');
        $utilisateur->statut = $request->input('statut');
        $utilisateur->save();

        return redirect()->route('users.list')->with('success', 'Utilisateur mis à jour avec succès');
    }
}