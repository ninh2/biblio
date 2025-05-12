@extends('layouts.app')

@section('title', 'Créer un auteur')

@section('content')
    <h1>Créer un auteur</h1>

    <div class="form-container">
        <form action="{{ route('auteurs.store') }}" method="POST">
            @csrf

            <!-- Champ Prénom -->
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>

            <!-- Champ Nom -->
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <button type="submit" class="btn btn-primary">Créer</button>
        </form>

        <a href="{{ route('auteurs.index') }}" class="btn btn-warning back-link">Retour à la liste des auteurs</a>
    </div>
@endsection
