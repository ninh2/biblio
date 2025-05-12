@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Créer un commentaire</h2>
        
        <form action="{{ route('commentaire.store') }}" method="POST">
            @csrf

            <!-- Sélectionner un ouvrage -->
            <div class="form-group">
                <label for="id_ouvrage">Titre de l'ouvrage</label>
                <select name="id_ouvrage" id="id_ouvrage" class="form-control" required>
                    <option value="">Sélectionnez un ouvrage</option>
                    @foreach ($ouvrages as $ouvrage)
                        <option value="{{ $ouvrage->id_ouvrage }}">{{ $ouvrage->titre }}</option>
                    @endforeach
                </select>
                @error('id_ouvrage')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Sélectionner un statut -->
            <div class="form-group">
                <label for="statut">Statut</label>
                <select name="statut" id="statut" class="form-control" required>
                    <option value="">Choisissez un statut</option>
                    <option value="en_attente">En attente</option>
                    <option value="Valide">Valide</option>
                </select>
                @error('statut')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Sélectionner une note -->
            <div class="form-group">
                <label for="note">Note</label>
                <select name="note" id="note" class="form-control" required>
                    <option value="">Choisissez une note</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                @error('note')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="btn btn-primary">Enregistrer le commentaire</button>
        </form>
    </div>
@endsection
