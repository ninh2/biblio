@extends('layouts.app')

@section('content')
    <h1>Modifier le Commentaire</h1>

    <!-- Formulaire de modification -->
    <form action="{{ route('commentaires.update', $commentaire->id_commentaire) }}" method="POST">
        @csrf
        @method('PUT')  <!-- Utilisation de PUT pour la mise à jour -->

        <!-- Sélectionner l'ouvrage -->
        <div class="form-group">
            <label for="id_ouvrage">Ouvrage</label>
            <select name="id_ouvrage" id="id_ouvrage" class="form-control">
                @foreach ($ouvrages as $ouvrage)
                    <option value="{{ $ouvrage->id_ouvrage }}" 
                        {{ $commentaire->id_ouvrage == $ouvrage->id_ouvrage ? 'selected' : '' }}>
                        {{ $ouvrage->titre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Statut -->
        <div class="form-group">
            <label for="statut">Statut</label>
            <select name="statut" id="statut" class="form-control">
                <option value="en_attente" {{ $commentaire->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="valide" {{ $commentaire->statut == 'valide' ? 'selected' : '' }}>Valide</option>
            </select>
        </div>

        <!-- Note -->
        <div class="form-group">
            <label for="note">Note</label>
            <select name="note" id="note" class="form-control" required>
                <option value="">Choisissez une note</option>
                <option value="1" {{ $commentaire->note == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $commentaire->note == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ $commentaire->note == 3 ? 'selected' : '' }}>3</option>
                <option value="4" {{ $commentaire->note == 4 ? 'selected' : '' }}>4</option>
                <option value="5" {{ $commentaire->note == 5 ? 'selected' : '' }}>5</option>
            </select>
            @error('note')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Bouton de mise à jour -->
        <button type="submit" class="btn btn-warning btn-sm">Mettre à jour</button>
    </form>
    
    <!-- Lien pour revenir à la liste des commentaires -->
    <a href="{{ route('commentaire.index') }}" class="btn btn-danger btn-sm">Retour à la liste des commentaires</a>
@endsection
