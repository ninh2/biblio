@extends('layouts.app')

@section('title', 'Modifier un auteur')

@section('content')
    <h1>Modifier un auteur</h1>

    <div class="form-container">
        <form action="{{ route('auteurs.update', $auteur->id_auteur) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Champ Prénom -->
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="{{ $auteur->prenom }}" required>

            <!-- Champ Nom -->
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="{{ $auteur->nom }}" required>

            <!-- Si tu as d'autres champs à ajouter pour l'auteur, tu peux le faire ici -->

            <button type="submit" class="btn btn-primary">Mettre à jour l'auteur</button>
        </form>

        <a href="{{ route('auteurs.index') }}" class="btn btn-warning back-link">Retour à la liste des auteurs</a>
    </div>
@endsection
