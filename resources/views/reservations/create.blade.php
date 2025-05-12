@extends('layouts.app')

@section('title', 'Créer une réservation')

@section('content')
    <div class="form-container">
        <h1>Créer une nouvelle Réservation</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="form" action="{{ route('reservations.store') }}" method="POST">
            @csrf

            @if (session('user') && session('user')['role'] === 'gestionnaire')
                <div class="form-group">
                    <label for="id_utilisateur">Utilisateur</label>
                    <select name="id_utilisateur" id="id_utilisateur" required>
                        <option value="">Sélectionner un utilisateur</option>
                        @foreach($utilisateurs as $utilisateur)
                            <option value="{{ $utilisateur->id_utilisateur }}" {{ old('id_utilisateur') == $utilisateur->id_utilisateur ? 'selected' : '' }}>
                                {{ $utilisateur->nom }} {{ $utilisateur->prenom }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_utilisateur')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            @else
                @if (session('user'))
                    <input type="hidden" name="id_utilisateur" value="{{ \App\Models\User::where('nom', session('user')['nom'])->where('prenom', session('user')['prenom'])->first()->id_utilisateur }}">
                @else
                    <div class="alert alert-warning">
                        Vous devez être connecté pour créer une réservation.
                        <a href="{{ route('Connexion') }}" class="alert-link">Se connecter</a>
                    </div>
                @endif
            @endif

            @if (session('user'))
                <div class="form-group">
                    <label for="id_ouvrage">Ouvrage</label>
                    <select name="id_ouvrage" id="id_ouvrage" required>
                        <option value="">Sélectionner un ouvrage</option>
                        @foreach($ouvrages as $ouvrage)
                            <option value="{{ $ouvrage->id_ouvrage }}" {{ old('id_ouvrage') == $ouvrage->id_ouvrage ? 'selected' : '' }}>
                                {{ $ouvrage->titre }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_ouvrage')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="date_reservation">Date de Réservation</label>
                    <input type="datetime-local" name="date_reservation" id="date_reservation" value="{{ old('date_reservation') }}" required>
                    @error('date_reservation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Créer la réservation</button>
            @endif
        </form>

        <a href="{{ route('reservations.index') }}" class="btn btn-warning back-link">Retour à la liste des réservations</a>
    </div>
@endsection