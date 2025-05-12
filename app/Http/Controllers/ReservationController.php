<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Ouvrages;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationController extends BaseController
{
    // Afficher la liste des réservations
    public function index()
    {
        $userSession = session('user');
        
        if ($userSession && $userSession['role'] === 'gestionnaire') {
            // Les gestionnaires voient toutes les réservations
            $reservations = Reservation::with(['ouvrage', 'utilisateur'])->get();
        } else {
            // Les non-gestionnaires ne voient que leurs propres réservations
            $userId = $userSession ? User::where('nom', $userSession['nom'])
                ->where('prenom', $userSession['prenom'])
                ->first()->id_utilisateur : null;
            
            $reservations = $userId ? Reservation::with(['ouvrage', 'utilisateur'])
                ->where('id_utilisateur', $userId)
                ->get() : collect([]);
        }

        return view('reservations.index', compact('reservations'));
    }

    // Afficher un formulaire pour créer une nouvelle réservation
    public function create()
    {
        $ouvrages = Ouvrages::all();
        $utilisateurs = User::all();
        return view('reservations.create', compact('ouvrages', 'utilisateurs'));
    }

    // Enregistrer une nouvelle réservation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_ouvrage' => 'required|exists:ouvrages,id_ouvrage',
            'id_utilisateur' => 'required|exists:utilisateurs,id_utilisateur',
            'date_reservation' => 'required|date',
        ]);

        Reservation::create($validated);
        return redirect()->route('reservations.index')->with('success', 'Réservation créée avec succès.');
    }

    // Afficher un formulaire pour modifier une réservation existante
    public function edit($id)
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }

        $reservation = Reservation::where('id_reservation', $id)->firstOrFail();
        $ouvrages = Ouvrages::all();
        $utilisateurs = User::all();
        return view('reservations.edit', compact('reservation', 'ouvrages', 'utilisateurs'));
    }

    // Mettre à jour une réservation
    public function update(Request $request, $id)
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }

        $validated = $request->validate([
            'id_ouvrage' => 'required|exists:ouvrages,id_ouvrage',
            'id_utilisateur' => 'required|exists:utilisateurs,id_utilisateur',
            'date_reservation' => 'required|date',
        ]);

        $reservation = Reservation::where('id_reservation', $id)->firstOrFail();
        $reservation->update($validated);
        return redirect()->route('reservations.index')->with('success', 'Réservation mise à jour avec succès.');
    }

    // Supprimer une réservation
    public function destroy($id)
    {
        if ($redirect = $this->restrictToGestionnaire()) {
            return $redirect;
        }

        $reservation = Reservation::where('id_reservation', $id)->firstOrFail();
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée avec succès.');
    }
}